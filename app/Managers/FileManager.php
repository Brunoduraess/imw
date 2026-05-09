<?php

namespace App\Managers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileManager
{
    public function __construct(
        protected string $disk = 'r2'
    ) {}

    public function upload(
        UploadedFile $file,
        string $directory,
        ?string $filename = null
    ): string {
        $filename ??= $this->generateFilename($file);

        return $file->storeAs($directory, $filename, $this->disk);
    }

    public function url(?string $path): ?string
    {
        if (!$path) {
            return null;
        }

        return Storage::disk($this->disk)->url($path);
    }

    public function delete(?string $path): bool
    {
        if (!$path) {
            return false;
        }

        return Storage::disk($this->disk)->delete($path);
    }

    public function exists(?string $path): bool
    {
        if (!$path) {
            return false;
        }

        return Storage::disk($this->disk)->exists($path);
    }

    public function replace(
        ?string $oldPath,
        UploadedFile $newFile,
        string $directory,
        ?string $filename = null
    ): string {
        $newPath = $this->upload($newFile, $directory, $filename);

        if ($oldPath) {
            $this->delete($oldPath);
        }

        return $newPath;
    }

    protected function generateFilename(UploadedFile $file): string
    {
        return Str::uuid() . '.' . $file->extension();
    }
}