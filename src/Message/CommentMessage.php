<?php
namespace App\Message;

class CommentMessage
{
    public function __construct(
        private int $id,
        private array $contex = [],
    ){

    }
    public function getId(): int
    {
        return $this->id;
    }
    public function getContext(): array
    {
        return $this->contex;
    }
}