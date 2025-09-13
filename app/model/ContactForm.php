<?php

namespace app\Model;

class ContactForm {
    private string $name;
    private string $surname;
    private string $email;
    private string $object;
    private string $message;
    private array $errors = [];

    public function __construct(array $postData) {
        $this->name = trim($postData['name'] ?? '');
        $this->surname = trim($postData['surname'] ?? '');
        $this->email = trim($postData['email'] ?? '');
        $this->object = trim($postData['object'] ?? '');
        $this->message = trim($postData['message'] ?? '');
    }

    public function validate(): bool {
        if (empty($this->name)) $this->errors['name'] = 'Le nom est obligatoire.';
        if (empty($this->surname)) $this->errors['surname'] = 'Le prénom est obligatoire.';
        if (empty($this->email)) {
            $this->errors['email'] = 'L’email est obligatoire.';
        } elseif (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = 'Format d’email invalide.';
        }
        if (empty($this->object)) $this->errors['object'] = 'L’objet est obligatoire.';
        if (empty($this->message)) $this->errors['message'] = 'Le message est obligatoire.';

        return empty($this->errors);
    }

    public function getErrors(): array {
        return $this->errors;
    }

    public function getName(): string { return htmlspecialchars($this->name); }
    public function getSurname(): string { return htmlspecialchars($this->surname); }
    public function getEmail(): string { return htmlspecialchars($this->email); }
    public function getObject(): string { return htmlspecialchars($this->object); }
    public function getMessage(): string { return htmlspecialchars($this->message); }
}

