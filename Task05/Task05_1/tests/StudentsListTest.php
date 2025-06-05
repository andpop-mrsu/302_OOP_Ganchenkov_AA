<?php

declare(strict_types=1);

namespace App\Tests;

use App\Student;
use App\StudentsList;
use PHPUnit\Framework\TestCase;

class StudentsListTest extends TestCase
{
    private StudentsList $list;

    protected function setUp(): void
    {
        $this->list = new StudentsList();
    }

    public function testCanAddAndIterateStudents(): void
    {
        $student1 = new Student(1, 'Смирнов Алексей Сергеевич');
        $student2 = new Student(2, 'Кузнецов Дмитрий Павлович');

        $this->list->add($student1);
        $this->list->add($student2);

        $result = [];
        foreach ($this->list as $id => $student) {
            $result[$id] = $student->getName();
        }

        $this->assertEquals([
            1 => 'Смирнов Алексей Сергеевич',
            2 => 'Кузнецов Дмитрий Павлович',
        ], $result);
    }

    public function testEmptyListIteration(): void
    {
        $result = [];
        foreach ($this->list as $id => $student) {
            $result[$id] = $student;
        }

        $this->assertEmpty($result);
    }

    public function testIteratorMethods(): void
    {
        $student = new Student(3, 'Васильев Игорь Николаевич');
        $this->list->add($student);

        $this->list->rewind();
        $this->assertTrue($this->list->valid());
        $this->assertEquals(3, $this->list->key());
        $this->assertSame($student, $this->list->current());

        $this->list->next();
        $this->assertFalse($this->list->valid());
    }
}