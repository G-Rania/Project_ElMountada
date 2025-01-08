<?php

class uploadingFiles_controller{

    public function uploadFile($file) {
        if ($file['error'] !== UPLOAD_ERR_OK) {
            throw new Exception("Erreur lors de l'upload du fichier : " . $file['error']);
        }

        $targetDir = "../../assets/uploads/";
        $targetFile = $targetDir . basename($file["name"]);

        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        if (move_uploaded_file($file["tmp_name"], $targetFile)) {
            return $targetFile;
        } else {
            throw new Exception("Impossible de déplacer le fichier téléchargé.");
        }
    }
}
?>