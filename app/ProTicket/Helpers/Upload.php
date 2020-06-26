<?php


    namespace App\ProTicket\Helpers;


    use Illuminate\Http\UploadedFile;
    use Illuminate\Support\Facades\Storage;
    use Ramsey\Uuid\Uuid;
    use Symfony\Component\HttpFoundation\File\File;

    class Upload
    {
        /**
         * @param string $type
         * @param string $path
         * @param UploadedFile $file
         * @return string
         * @throws \Exception
         */
        public static function uploadFile(string $type, string $path, UploadedFile $file): string
        {
            try{
                $fileName = self::generateNameImage($file);

                $created = '';
                $return = '';
                switch ($type) {
                    case 'image':
                        $created = self::uploadImage($path, $file, $fileName);
                        $return =  $created->getPathname();
                        break;
                    case 'document':
                        $created = self::uploadDocument($path, $file, $fileName);
                        $return = $created;
                        break;
                }

                return  $return;
            }catch (\Exception $exception){
                LogError::Log($exception);
                throw new \Exception('Erro ao realizar o upload da imagem',500);
            }
        }

        /**
         * @param string $path
         * @return bool
         */
        public static function deleteFile(string $path) : bool {
            return Storage::deleteDirectory($path);
        }
        /**
         * @param UploadedFile $file
         * @return string
         * @throws \Exception
         */
        private static function generateNameImage(UploadedFile $file): string
        {
            return Uuid::uuid4()->toString() . '.' . $file->getClientOriginalExtension();
        }

        /**
         * @param string $path
         * @param UploadedFile $file
         * @param string $name
         * @return File
         */
        private static function uploadImage(string $path, UploadedFile $file, string $name): File
        {
            return $file->move($path, $name);
        }

        private static function uploadDocument(string $path, UploadedFile $file, string $name){

            return Storage::putFileAs($path,$file,$name);
        }

    }
