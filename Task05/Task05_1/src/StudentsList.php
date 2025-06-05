<?php

declare(strict_types=1);

namespace App;

use Iterator;

class StudentsList implements Iterator
{
    private array $students = [];
    private int $position = 0;

    public function add(Student $student): void
    {
        $this->students[$student->getId()] = $student;
    }

    public function rewind(): void
    {
        $this->position = 0;
    }

    public function current(): Student
    {
        return $this->students[array_keys($this->students)[$this->position]];
    }

    public function key(): int
    {
        return array_keys($this->students)[$this->position];
    }

    public function next(): void
    {
        ++$this->position;
    }

    public function valid(): bool
    {
        return isset(array_keys($this->students)[$this->position]);
    }
}