<?php
namespace App\Service;

use Symfony\Bundle\SecurityBundle\Security;

Class EncryptService{

    private string $key;
    private string $iv;

    public function __construct(
        private Security $security,

    )
    {
        if (!$this->security->getUser()) {
            throw new \LogicException('The encrypt service requires an authenticated user.');
        }
        else{

            $this->key = hash('sha256',$this->security->getUser()->getEmail());
            $this->iv = $this->generateIv($this->security->getUser()->getEmail());
        }
    }

    private function generateIv(string $data): string
    {
        return substr(hash('sha256', hash('sha1', $data)), 0, 16);
    }


    /**
     * Encrypt a string 
     */
    public function encrypt($data) :string
    {
        
        $encrypted = openssl_encrypt($data, 'AES-256-CBC', $this->key, 0, $this->iv);

        return $encrypted;
    }

    
    
    public function decrypt(string $encrypted)
    {
        $decrypted = openssl_decrypt($encrypted, 'AES-256-CBC', $this->key, 0, $this->iv);

        return $decrypted;
    }
}
    