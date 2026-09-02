<?php

namespace App\Services;

use Google\Client;
use Google\Service\Drive;

class GoogleDriveService
{
    protected Drive $drive;
    protected string $folderId;

    public function __construct()
    {
        $client = new Client();

        $credentialsPath = base_path(
            config('services.google_drive.service_account_path')
        );

        $client->setAuthConfig($credentialsPath);

        $client->addScope(Drive::DRIVE_READONLY);

        $this->drive = new Drive($client);

        $this->folderId = config('services.google_drive.folder_id');
    }


    public function findPdfByOrder(string $orderNumber): ?array
    {
        $fileName = trim($orderNumber) . '.pdf';

        $query = sprintf(
            "'%s' in parents and name = '%s' and mimeType = 'application/pdf' and trashed = false",
            $this->escapeQueryValue($this->folderId),
            $this->escapeQueryValue($fileName)
        );

        $files = $this->drive->files->listFiles([
            'q' => $query,
            'fields' => 'files(id, name, webViewLink, webContentLink)',
            'pageSize' => 1,
        ]);

        if (count($files->getFiles()) === 0) {
            return null;
        }

        $file = $files->getFiles()[0];

        return [
            'id' => $file->getId(),
            'name' => $file->getName(),
            'web_view_link' => $file->getWebViewLink(),
            'web_content_link' => $file->getWebContentLink(),
        ];
    }


    private function escapeQueryValue(string $value): string
    {
        return str_replace(
            ["\\", "'"],
            ["\\\\", "\\'"],
            $value
        );
    }
}