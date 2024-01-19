<?php

namespace App\Jobs;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Shift;
use App\Models\Status;
use App\Models\Company;
use App\Models\ShiftType;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UploadParsedCSV implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 300;
    
    /**
     * Create a new job instance.
     */
    public function __construct(public $path)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $dataForImport = [];
        $i = 0;
        $file = fopen('storage/app/public/' . $this->path, 'r');

        while (($filedata = fgetcsv($file, 1000, ",")) !== false) {
            $count = count($filedata);

            if ($i == 0) {
                $i++;
                continue;
            }
            for ($c = 0; $c < $count; $c++) {
                $dataForImport[$i][] = $filedata[$c];
            }
            $i++;
        }
        fclose($file);

        $data = [];
        foreach($dataForImport as $item){
            $userId = $this->getId(User::class, $item[1]);
            $companyId = $this->getId(Company::class, $item[2]);
            $hours = (int) $item[3];
            $ratePerHour = (int) preg_replace('/[^0-9.]/', '', $item[4]);
            $taxable = $item[5] == 'Yes' ? true : false;
            $statusId = $this->getId(Status::class, $item[6]);
            $shiftTypeId = $this->getId(ShiftType::class, $item[7]);
            $data = [
                'date' => str_replace(',', '-', $item[0]),
                'user_id' => $userId,
                'company_id' => $companyId,
                'hours' => $hours,
                'rate_per_hour' => $ratePerHour,
                'total_pay' => $ratePerHour * $hours,
                'taxable' => $taxable,
                'status_id' => $statusId,
                'shift_type_id' => $shiftTypeId,
                'paid_at' => Carbon::make(str_replace(',', '-', $item[8])),
                'created_at' => now(),
                'updated_at' => now()
            ];
            Shift::insert($data);
        }

        // foreach (array_chunk($data, 1000) as $d){
        //     Shift::insert($d);
        // }

        
        Storage::disk('public')->delete($this->path);
    }

    private function getId($model, $item) : int {
        $entity = $model::firstOrCreate(
            ['name' => $item]
        );
        return $entity->id;
    }
}
