<?php

declare(strict_types=1);
require_once dirname(__DIR__) . '/bootstrap.php';

function check(bool $condition, string $description): void
{
    if (!$condition) throw new RuntimeException('FAIL: ' . $description);
    echo 'PASS: ' . $description . PHP_EOL;
}

function rejects(callable $callback, string $description): void
{
    try {
        $callback();
    } catch (InvalidArgumentException $e) {
        check(true, $description);
        return;
    } catch (Throwable $e) {
        check(true, $description);
        return;
    }
    throw new RuntimeException('FAIL: ' . $description);
}

$regular = new RegularStudent('001', '  Alice  ', 'Computer Science', 3, 5000000);
$scholar = new ScholarshipStudent('002', 'Bob', 'Computer Science', 4, 5000000, 40);
$exchange = new ExchangeStudent('003', 'Charlie', 'Informatics', 5, 4500000, 'NTU Singapore');

// 1. Inheritance checks
check($regular instanceof Student && $scholar instanceof Student && $exchange instanceof Student, 'All child objects are Student instances (Polymorphism / is-a relationship)');
check($regular->getName() === 'Alice', 'Parent constructor trims name');
check($regular->getType() === 'Regular' && $scholar->getType() === 'Scholarship' && $exchange->getType() === 'Exchange', 'Overridden getType');

// 2. Abstract method overriding: calculateTuition()
check($regular->calculateTuition() === 5000000.0, 'Regular tuition calculation');
check($scholar->calculateTuition() === 3000000.0, 'Scholarship tuition calculation (40% discount)');
check($exchange->calculateTuition() === 4500000.0, 'Exchange student tuition calculation');
check($scholar->getStudentId() === '002', 'Inherited getter getStudentId');

// 3. Concrete method overriding: getDescription() calling parent::getDescription()
check(str_contains($regular->getDescription(), '001 - Alice'), 'Inherited parent getDescription()');
check(str_contains($scholar->getDescription(), '002 - Bob') && str_contains($scholar->getDescription(), '[Scholarship: 40%]'), 'Overridden getDescription() calling parent::getDescription() in ScholarshipStudent');
check(str_contains($exchange->getDescription(), '003 - Charlie') && str_contains($exchange->getDescription(), '[Exchange: NTU Singapore]'), 'Overridden getDescription() calling parent::getDescription() in ExchangeStudent');

// 4. StudentRepository polymorphic CRUD
$repo = new StudentRepository();
check($repo->add($regular) && $repo->add($scholar) && $repo->add($exchange), 'Repository accepts all 3 child classes (Polymorphism)');
check(!$repo->add($regular), 'Duplicate ID rejected');
check(count($repo->all()) === 3, 'Read all students');
check($repo->find('002') === $scholar, 'Find student');
check($repo->update('002', new ScholarshipStudent('002', 'Bobby', 'IT', 5, 6000000, 50)), 'Update student');
check($repo->find('002')?->calculateTuition() === 3000000.0, 'Updated tuition via overriding');
check($repo->delete('001') && $repo->find('001') === null, 'Delete student');
check(count($repo->all()) === 2, 'Count after deletion');

// 5. Validation checks
rejects(fn() => new RegularStudent('004', 'C', 'IT', 0, 100), 'Invalid semester rejected (< 1)');
rejects(fn() => new RegularStudent('004', 'C', 'IT', 15, 100), 'Invalid semester rejected (> 14)');
rejects(fn() => new ScholarshipStudent('004', 'C', 'IT', 2, 100, 101), 'Invalid discount rejected (> 100%)');
rejects(fn() => new ScholarshipStudent('004', 'C', 'IT', 2, 100, -5), 'Invalid discount rejected (< 0%)');
rejects(fn() => new ExchangeStudent('004', 'C', 'IT', 2, 100, '   '), 'Empty partner university rejected');
rejects(fn() => $repo->update('002', new RegularStudent('999', 'C', 'IT', 2, 100)), 'Changing student ID rejected');

// 6. StudentPresenter (__call overloading)
$presenter = new StudentPresenter();
check($presenter->showData('Alice') === 'Nama: Alice', '__call with 1 argument');
check(str_contains($presenter->showData('001', 'Alice'), 'NIM: 001'), '__call with 2 arguments');
check(str_contains($presenter->showData('001', 'Alice', 'TI'), 'Prodi: TI'), '__call with 3 arguments');
check(str_contains($presenter->showData('001', 'Alice', 'TI', 3), 'Semester: 3'), '__call with 4 arguments');
rejects(fn() => $presenter->showData(), 'Invalid argument count on __call rejected');
rejects(fn() => $presenter->unknownMethod(), 'Unknown method on __call rejected');

check(!property_exists($regular, 'nonexistent'), 'Object remains well-defined');
echo 'All tests passed successfully!' . PHP_EOL;
