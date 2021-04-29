<?php
namespace App\Imports;

use Illuminate\Support\Collection;
use App\Models\UserFileData;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\HeadingRowImport;

class DataImport implements ToCollection,WithHeadingRow
{
	private $file;

	public function __construct($file)
	{
		$this->file = $file;
	}

	public function collection(Collection $rows)
	{
		foreach ($rows as $index => $row){
			$keys = array_keys($row->toArray());
			foreach ($keys as $key) {
				$data = UserFileData::create([
					'user_id'=>$this->file->user_id,
					'user_file_id'=>$this->file->id,
					'row_number' => $index,
					'key'  => $key,
					'value' => $row[$key],
				]);
			}
		}
	}
}