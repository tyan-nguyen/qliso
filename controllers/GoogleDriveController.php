<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use Google\Client;
use Google\Service\Drive;
use Google\Service\Drive\DriveFile;
use Google\Service\Drive\Permission;

define('STDIN',fopen("php://stdin","r"));

class GoogleDriveController extends Controller {
    
    public function actionTestSetup(){
        $client = new Client();
        $client->setApplicationName("Client_Library_Examples");
        $client->setDeveloperKey("YOUR_APP_KEY");
        
        $service = new Google\Service\Books($client);
        $query = 'Henry David Thoreau';
        $optParams = [
            'filter' => 'free-ebooks',
        ];
        $results = $service->volumes->listVolumes($query, $optParams);
        
        foreach ($results->getItems() as $item) {
            echo $item['volumeInfo']['title'], "<br /> \n";
        }
    }
    public function actionUpload4(){
        try {
            $client = new Client();
            $client->setAuthConfig('credentials.json');
            $client->useApplicationDefaultCredentials();
            $client->addScope(Drive::DRIVE);
            $driveService = new Drive($client);
            $fileMetadata = new Drive\DriveFile(array(
                'name' => 'photo.jpg'));
            $content = file_get_contents(Yii::getAlias('@webroot') . '/images/test.jpg');
            $file = $driveService->files->create($fileMetadata, array(
                'data' => $content,
                'mimeType' => 'image/jpeg',
                'uploadType' => 'multipart',
                'fields' => 'id'));
            printf("File ID: %s\n", $file->id);
            return $file->id;
        } catch(\Exception $e) {
            echo "Error Message: ".$e;
        } 
    }
    
    public function actionUpload2(){
        
        $client = new Client();
        /* Get your credentials from the console */
        $client->setClientId('334834496758-cht6o914su0fuv0v4o3q99kncu81kskd.apps.googleusercontent.com');
        $client->setClientSecret('9lSiwonLskdwqGTMdjC5i2L4');
        $client->setRedirectUri('http://localhost/qlbm/google-drive/success');
        
        $driveService = new Drive($client);
        $fileMetadata = new DriveFile(array(
            'name' => 'photo.jpg'));
        $content = file_get_contents(Yii::getAlias('@webroot') . '/images/test.jpg');
        $file = $driveService->files->create($fileMetadata, array(
            'data' => $content,
            'mimeType' => 'image/jpeg',
            'uploadType' => 'multipart',
            'fields' => 'id'));
        printf("File ID: %s\n", $file->id);
        
    }
    
    public function actionUpload3(){
        // Get the API client and construct the service object.
        $client = $this->getClient();
        $service = new Drive($client);
        
        // Print the names and IDs for up to 10 files.
        $optParams = array(
            'pageSize' => 10,
            'fields' => 'nextPageToken, files(id, name)'
        );
        $results = $service->files->listFiles($optParams);
        
        if (count($results->getFiles()) == 0) {
            print "No files found.\n";
        } else {
            print "Files:\n";
            foreach ($results->getFiles() as $file) {
                printf("%s (%s)\n", $file->getName(), $file->getId());
            }
        }
    }
    
    public function actionUpload(){
        $client = new Client();
        /* Get your credentials from the console */
        $client->setClientId('334834496758-cht6o914su0fuv0v4o3q99kncu81kskd.apps.googleusercontent.com');
        $client->setClientSecret('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');
        $client->setRedirectUri('http://localhost/qlbm/google-drive/upload');
        $client->setScopes(array('https://www.googleapis.com/auth/drive.file'));
        
        session_start();
        
        if (isset($_GET['code']) || (isset($_SESSION['access_token']) && $_SESSION['access_token'])) {
            if (isset($_GET['code'])) {
                $client->authenticate($_GET['code']);
                $_SESSION['access_token'] = $client->getAccessToken();
            } else
                $client->setAccessToken($_SESSION['access_token']);
                
                $service = new Drive($client);
                
                /* Insert a file */
                $file = new DriveFile();
                //$file->setName(uniqid().'.jpg');
                $file->setName('thisistest3.jpg');
                $file->setDescription('A test document');
                $file->setMimeType('image/jpeg');
                $file->setParents(['1q6L-6dAsngIU6BGmsIHT36mW5S21f37F']);
                /* $permission = new Permission();
                $permission->type = "user";
                $permission->role = "writer";
                $permission->emailAddress = "travinhfashion@gmail.com";
                
                $file->setPermissions([$permission]); */
                
                /* $file->setPermissions([
                       [ 
                            "kind" => "drive#permission",
                            'type' => 'user',
                            'role' => 'writer',
                            'emailAddress' => 'travinhfashion@gmail.com',  # Email of Google account.
                        ]
                ]); */
                
                $data = file_get_contents(Yii::getAlias('@webroot') . '/images/test.jpg');
                
                $createdFile = $service->files->create($file, array(
                    'data' => $data,
                    'mimeType' => 'image/jpeg',
                    'uploadType' => 'multipart'
                ));
                
                print_r($createdFile);
               echo '<br/>';
               echo '------' . $createdFile["id"];
               
               //set permission
               $fileId = $createdFile["id"];
               $service->getClient()->setUseBatch(true);
               $batch = $service->createBatch();
               
               $userPermission = new Drive\Permission(array(
                   'type' => 'user',
                   'role' => 'writer',
                   'emailAddress' => 'travinhfashion@gmail.com'
               ));               
               //$userPermission['emailAddress'] = $realUser;
               $request = $service->permissions->create(
                   $fileId, $userPermission, array('fields' => 'id'));
               $batch->add($request, 'user');
               $results = $batch->execute();
               
               $userPermission2 = new Drive\Permission(array(
                   'type' => 'user',
                   'role' => 'reader',
                   'emailAddress' => 'khucthuydu.2801@gmail.com'
               ));
               //$userPermission['emailAddress'] = $realUser;
               $request2 = $service->permissions->create(
                   $fileId, $userPermission2, array('fields' => 'id'));
               $batch->add($request2, 'user');
               
               $results = $batch->execute();
               
                
        } else {
            $authUrl = $client->createAuthUrl();
            header('Location: ' . $authUrl);
            exit();
        }
        
    }
    
    //test create a folder from google drive
    public function actionTestCreateFolder(){
            try {
                $client = new Client();
                $client->useApplicationDefaultCredentials();
                $client->addScope(Drive::DRIVE);
                $driveService = new Drive($client);
                $fileMetadata = new Drive\DriveFile(array([
                    'name' => 'Invoices',
                    'mimeType' => 'application/vnd.google-apps.folder']));
                $file = $driveService->files->create($fileMetadata, array([
                    'fields' => 'id']));
                printf("Folder ID: %s\n", $file->id);
                return $file->id;
                
            }catch(\Exception $e) {
                echo "Error Message: ".$e;
            }
    }
    
    public function actionSuccess(){
        echo 'this is success action redirect from google drive...';
    }
    
    /**
     * Returns an authorized API client.
     * @return Client the authorized client object
     */
    public function getClient()
    {
        $client = new Client();
        
        $client->setApplicationName('Google Drive API PHP Quickstart');
        $client->setRedirectUri('http://localhost/qlbm/google-drive/upload3');
        
        $client->setScopes(Drive::DRIVE_METADATA_READONLY);
        $client->setAuthConfig('credentials.json');
        $client->setAccessType('offline');
        $client->setPrompt('select_account consent');
        
        // Load previously authorized token from a file, if it exists.
        // The file token.json stores the user's access and refresh tokens, and is
        // created automatically when the authorization flow completes for the first
        // time.
        $tokenPath = 'token.json';
        if (file_exists($tokenPath)) {
            $accessToken = json_decode(file_get_contents($tokenPath), true);
            $client->setAccessToken($accessToken);
        }
        
        // If there is no previous token or it's expired.
        if ($client->isAccessTokenExpired()) {
            // Refresh the token if possible, else fetch a new one.
            if ($client->getRefreshToken()) {
                $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
            } else {
                // Request authorization from the user.
                $authUrl = $client->createAuthUrl();
                printf("Open the following link in your browser:\n%s\n", $authUrl);
                print 'Enter verification code: ';
                $authCode = trim(fgets(STDIN));
                
                // Exchange authorization code for an access token.
                $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
                $client->setAccessToken($accessToken);
                
                print '--token:' . $accessToken;
                
                // Check to see if there was an error.
                if (array_key_exists('error', $accessToken)) {
                    throw new \Exception(join(', ', $accessToken));
                }
            }
            // Save the token to a file.
            if (!file_exists(dirname($tokenPath))) {
                mkdir(dirname($tokenPath), 0700, true);
            }
            file_put_contents($tokenPath, json_encode($client->getAccessToken()));
            

        }
        return $client;
    }
    
}