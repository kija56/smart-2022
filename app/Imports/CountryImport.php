<?php

namespace App\Imports;

use App\Models\Country;
use App\Models\Record;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Validators\Failure;

class CountryImport implements ToCollection,SkipsOnFailure,WithHeadingRow,WithChunkReading
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function collection(Collection $rows)
    { 
        foreach ($rows as $key => $row) {
            DB::beginTransaction();
            $country = Country::create([
                'name' => $row['country_name'],
                'code' => $row['country_code']
            ]);

            $yearlyData = $row->slice(3);
            $this->storeRecord($yearlyData,$country);
            DB::commit();
        }
    }

    private function storeRecord($yearlyData,$country)
    {
        try {
            foreach($yearlyData as $key=>$record){
                $countryRecord = Record::create([
                    'year' => $key,
                    'life_expectancy' => $record ?? 0
                ]);
                $countryRecord->country()->associate($country);
                $countryRecord->save();
            }
        } catch (\Exception $th) {
            throw $th;
        }
    }

    /**
     * @param Failure[] $failures
     */
    public function onFailure(Failure ...$failures)
    {

    }

    public function headingRow(): int
    {
        return 3;
    }

    public function chunkSize(): int
    {
        return 50;
    }
}
