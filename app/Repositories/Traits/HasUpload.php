<?php

namespace App\Repositories\Traits;

use App\Models\Upload;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait HasUpload
{
    public function upload($model, array $data): void
    {
        $file = data_get($data, 'image');

        if (empty($file)) {
            return;
        }

        if ($model->image()->exists()) {
            $model->image->delete();
        }

        $fileName = date('YmdHis') . '_' . $file->getClientOriginalName();
        Storage::disk('local')->put($fileName, $file->get());
        $model->image()->create(['name' => $fileName]);
        data_forget($data, 'image');
    }

    public function deleteFile(string $filePath = ''): void
    {
        if (Storage::disk('local')->exists($filePath)) {
            Storage::disk('local')->delete($filePath);
        }
    }
}
