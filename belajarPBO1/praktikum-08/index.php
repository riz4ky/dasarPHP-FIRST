<?php

declare(strict_types=1);
require_once __DIR__ . '/bootstrap.php'; // Load classes BEFORE session_start().
session_start();

if (!isset($_SESSION['repository']) || !($_SESSION['repository'] instanceof StudentRepository)) {
    $repo = new StudentRepository();
    // Default sample data showcasing polymorphism & inheritance
    $repo->add(new RegularStudent('001', 'Alice Johnson', 'Computer Science', 3, 5000000));
    $repo->add(new ScholarshipStudent('002', 'Bob Smith', 'Information Systems', 4, 5000000, 40));
    $repo->add(new ExchangeStudent('003', 'Charlie Brown', 'Software Engineering', 5, 4500000, 'NTU Singapore'));
    $_SESSION['repository'] = $repo;
}
/** @var StudentRepository $repository */
$repository = $_SESSION['repository'];
$error = '';
$success = '';
$selected = null;

function h(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}
function money(float $value): string
{
    return 'Rp ' . number_format($value, 0, ',', '.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $action = (string) ($_POST['action'] ?? '');
        if ($action === 'delete') {
            $id = trim((string) ($_POST['student_id'] ?? ''));
            if (!$repository->delete($id)) throw new InvalidArgumentException('Student not found.');
            $success = 'Student deleted successfully.';
        } elseif ($action === 'save') {
            $id = trim((string) ($_POST['student_id'] ?? ''));
            $name = (string) ($_POST['name'] ?? '');
            $major = (string) ($_POST['major'] ?? '');
            $semester = filter_var($_POST['semester'] ?? null, FILTER_VALIDATE_INT);
            $tuition = filter_var($_POST['tuition'] ?? null, FILTER_VALIDATE_FLOAT);
            $discount = filter_var($_POST['discount'] ?? '0', FILTER_VALIDATE_FLOAT);
            $partnerUniversity = trim((string) ($_POST['partner_university'] ?? ''));

            if ($semester === false || $tuition === false || $discount === false) {
                throw new InvalidArgumentException('Semester, tuition and discount must be valid numbers.');
            }

            $type = (string) ($_POST['type'] ?? '');
            if ($type === 'regular') {
                $student = new RegularStudent($id, $name, $major, $semester, $tuition);
            } elseif ($type === 'scholarship') {
                $student = new ScholarshipStudent($id, $name, $major, $semester, $tuition, $discount);
            } elseif ($type === 'exchange') {
                if ($partnerUniversity === '') {
                    $partnerUniversity = 'International Partner University';
                }
                $student = new ExchangeStudent($id, $name, $major, $semester, $tuition, $partnerUniversity);
            } else {
                throw new InvalidArgumentException('Choose a valid student type.');
            }

            $mode = (string) ($_POST['mode'] ?? 'add');
            if ($mode === 'edit') {
                if (!$repository->update($id, $student)) throw new InvalidArgumentException('Student not found.');
                $success = 'Student updated successfully.';
            } elseif ($mode === 'add') {
                if (!$repository->add($student)) throw new InvalidArgumentException('Student ID already exists.');
                $success = 'Student added successfully.';
            } else {
                throw new InvalidArgumentException('Invalid form mode.');
            }
        } else {
            throw new InvalidArgumentException('Unknown action.');
        }
        $_SESSION['repository'] = $repository;
        $_SESSION['flash'] = $success;
        header('Location: index.php');
        exit;
    } catch (InvalidArgumentException $e) {
        $error = $e->getMessage();
    }
}

if (isset($_SESSION['flash'])) {
    $success = (string) $_SESSION['flash'];
    unset($_SESSION['flash']);
}
if (isset($_GET['edit'])) $selected = $repository->find((string) $_GET['edit']);
$search = trim((string) ($_GET['q'] ?? ''));
$rows = array_filter($repository->all(), static function (Student $s) use ($search): bool {
    return $search === '' || stripos($s->getStudentId() . ' ' . $s->getName() . ' ' . $s->getMajor() . ' ' . $s->getDescription(), $search) !== false;
});
$presenter = new StudentPresenter();
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Student CRUD — Inheritance & Polymorphism</title>
  <style>
  :root {
    font-family: system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, sans-serif;
    color: #172c4c;
    background: #f3f7fc
  }

  body {
    max-width: 1120px;
    margin: 35px auto;
    padding: 0 16px
  }

  h1 {
    margin-bottom: 4px;
    display: flex;
    align-items: center;
    gap: 10px;
  }

  p {
    color: #5b6980
  }

  .panel {
    background: #fff;
    border-radius: 14px;
    padding: 22px;
    margin: 20px 0;
    box-shadow: 0 6px 24px #102b5010;
    border: 1px solid #e2e8f0;
  }

  .fields {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
    gap: 14px
  }

  label {
    display: block;
    font-size: 13px;
    font-weight: 650;
    margin-bottom: 5px
  }

  input,
  select {
    box-sizing: border-box;
    width: 100%;
    padding: 10px;
    border: 1px solid #cbd5e1;
    border-radius: 7px;
    font-size: 14px;
  }

  button,
  .btn {
    background: #1764b5;
    color: white;
    padding: 10px 16px;
    border: 0;
    border-radius: 7px;
    font-weight: 600;
    cursor: pointer;
    text-decoration: none;
    display: inline-block;
    transition: background 0.15s ease;
  }

  button:hover,
  .btn:hover {
    background: #115094;
  }

  .muted {
    background: #e8eff7;
    color: #183a61
  }

  .muted:hover {
    background: #d6e3f2;
  }

  .danger {
    background: #c33849
  }

  .danger:hover {
    background: #a12a38;
  }

  .actions {
    display: flex;
    gap: 7px;
    align-items: center
  }

  .alert {
    padding: 12px 16px;
    border-radius: 8px;
    background: #e4f8e9;
    color: #1b6032;
    margin-bottom: 16px;
    font-weight: 500;
  }

  .error {
    background: #ffe7e7;
    color: #9c1f2e;
  }

  table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
  }

  th,
  td {
    text-align: left;
    padding: 11px 12px;
    border-bottom: 1px solid #e4eaf2
  }

  th {
    background: #e9f2fd;
    font-size: 13px;
    font-weight: 650;
    color: #274066;
  }

  .tag {
    display: inline-block;
    padding: 3px 8px;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 600;
  }

  .tag-regular {
    background: #e2f0fd;
    color: #12579b;
  }

  .tag-scholarship {
    background: #e6f9ed;
    color: #13773b;
  }

  .tag-exchange {
    background: #fff4e5;
    color: #9a5307;
  }

  .desc-box {
    font-size: 12px;
    color: #556987;
    margin-top: 4px;
    font-family: Consolas, monospace;
    background: #f8fafc;
    padding: 3px 6px;
    border-radius: 4px;
    border: 1px solid #e2e8f0;
  }

  .demo-box {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 14px;
    font-size: 13px;
    line-height: 1.6;
  }

  small {
    color: #65758b
  }

  .scroll {
    overflow-x: auto
  }
  </style>
</head>

<body>
  <h1>🎓 Student CRUD — Inheritance & Polymorphism</h1>
  <p>OOP Session 06 / 08 · Abstract classes, method overriding (abstract & concrete parent::), polymorphism, and overloading</p>
  
  <?php if ($success !== ''): ?><div class="alert"><?= h($success) ?></div><?php endif; ?>
  <?php if ($error !== ''): ?><div class="alert error"><?= h($error) ?></div><?php endif; ?>

  <section class="panel">
    <h2><?= $selected ? 'Edit Student' : 'Add Student' ?></h2>
    <form method="post">
      <input type="hidden" name="action" value="save">
      <input type="hidden" name="mode" value="<?= $selected ? 'edit' : 'add' ?>">
      <div class="fields">
        <div>
          <label>Student ID (immutable)</label>
          <input name="student_id" required value="<?= h($selected?->getStudentId() ?? '') ?>" <?= $selected ? 'readonly' : '' ?>>
        </div>
        <div>
          <label>Name</label>
          <input name="name" required value="<?= h($selected?->getName() ?? '') ?>">
        </div>
        <div>
          <label>Major</label>
          <input name="major" required value="<?= h($selected?->getMajor() ?? '') ?>">
        </div>
        <div>
          <label>Semester (1–14)</label>
          <input name="semester" type="number" min="1" max="14" required value="<?= h((string)($selected?->getSemester() ?? 1)) ?>">
        </div>
        <div>
          <label>Student type</label>
          <select name="type" id="type">
            <option value="regular" <?= ($selected instanceof RegularStudent || !$selected) ? 'selected' : '' ?>>Regular Student</option>
            <option value="scholarship" <?= ($selected instanceof ScholarshipStudent) ? 'selected' : '' ?>>Scholarship Student</option>
            <option value="exchange" <?= ($selected instanceof ExchangeStudent) ? 'selected' : '' ?>>Exchange Student</option>
          </select>
        </div>
        <div>
          <label>Base tuition (IDR)</label>
          <input name="tuition" type="number" min="0" step="0.01" required value="<?= h((string)($selected?->getBaseTuition() ?? 4000000)) ?>">
        </div>
        <div id="discount-field">
          <label>Scholarship discount (%)</label>
          <input name="discount" id="discount-input" type="number" min="0" max="100" step="0.01" value="<?= h((string)($selected?->getDiscountPercent() ?? 25)) ?>">
        </div>
        <div id="partner-field">
          <label>Partner University</label>
          <input name="partner_university" id="partner-input" placeholder="e.g. NTU Singapore" value="<?= h(($selected instanceof ExchangeStudent) ? $selected->getPartnerUniversity() : 'International Partner University') ?>">
        </div>
      </div>
      <p style="margin-top:16px">
        <button type="submit"><?= $selected ? 'Save Changes' : 'Add Student' ?></button> 
        <a class="btn muted" href="index.php">Reset</a>
      </p>
    </form>
  </section>

  <section class="panel">
    <h2>Student List (<?= count($rows) ?>)</h2>
    <form method="get" class="actions" style="margin-bottom:16px">
      <input name="q" placeholder="Search ID, name, major, or description" value="<?= h($search) ?>">
      <button>Search</button>
      <a class="btn muted" href="index.php">All</a>
    </form>
    <div class="scroll">
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Name & Major</th>
            <th>Description (Overriding parent::)</th>
            <th>Semester</th>
            <th>Type</th>
            <th>Base Tuition</th>
            <th>Discount / Notes</th>
            <th>Final Tuition</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($rows as $student): ?>
          <tr>
            <td><strong><?= h($student->getStudentId()) ?></strong></td>
            <td>
              <div><strong><?= h($student->getName()) ?></strong></div>
              <small><?= h($student->getMajor()) ?></small>
            </td>
            <td>
              <div class="desc-box"><?= h($student->getDescription()) ?></div>
            </td>
            <td><?= $student->getSemester() ?></td>
            <td>
              <?php if ($student instanceof ScholarshipStudent): ?>
                <span class="tag tag-scholarship">Scholarship</span>
              <?php elseif ($student instanceof ExchangeStudent): ?>
                <span class="tag tag-exchange">Exchange</span>
              <?php else: ?>
                <span class="tag tag-regular">Regular</span>
              <?php endif; ?>
            </td>
            <td><?= money($student->getBaseTuition()) ?></td>
            <td>
              <?php if ($student instanceof ScholarshipStudent): ?>
                <span style="color:#13773b;font-weight:600"><?= number_format($student->getDiscountPercent(), 1) ?>%</span>
              <?php elseif ($student instanceof ExchangeStudent): ?>
                <small><?= h($student->getPartnerUniversity()) ?></small>
              <?php else: ?>
                <small>—</small>
              <?php endif; ?>
            </td>
            <td><strong><?= money($student->calculateTuition()) ?></strong></td>
            <td>
              <div class="actions">
                <a class="btn muted" href="?edit=<?= urlencode($student->getStudentId()) ?>">Edit</a>
                <form method="post" onsubmit="return confirm('Delete this student?')">
                  <input type="hidden" name="action" value="delete">
                  <input type="hidden" name="student_id" value="<?= h($student->getStudentId()) ?>">
                  <button class="danger">Delete</button>
                </form>
              </div>
            </td>
          </tr>
          <?php endforeach; ?>
          <?php if (!$rows): ?>
          <tr>
            <td colspan="9" style="text-align:center;padding:24px;color:#65758b">No students found.</td>
          </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
    <p><small>Data is stored in PHP Session for classroom practice, not in a database.</small></p>
  </section>

  <section class="panel">
    <h2>OOP Concept Demonstration</h2>
    <div class="demo-box">
      <p><strong>1. Method Overriding (Abstract):</strong> <code>Student::calculateTuition()</code> is abstract and implemented differently by <code>RegularStudent</code>, <code>ScholarshipStudent</code>, and <code>ExchangeStudent</code>.</p>
      <p><strong>2. Method Overriding (Concrete with parent::):</strong> <code>Student::getDescription()</code> provides the base format. <code>ScholarshipStudent::getDescription()</code> and <code>ExchangeStudent::getDescription()</code> call <code>parent::getDescription()</code> and append subclass details.</p>
      <p><strong>3. Polymorphism:</strong> <code>StudentRepository</code> accepts any subclass implementing <code>Student</code>.</p>
      <p><strong>4. PHP Overloading (__call):</strong> <code>StudentPresenter</code> demonstrates dynamic method invocation:</p>
      <ul>
        <li><code>$presenter->showData('Alice')</code> &rarr; <em><?= h($presenter->showData('Alice')) ?></em></li>
        <li><code>$presenter->showData('001', 'Alice')</code> &rarr; <em><?= h($presenter->showData('001', 'Alice')) ?></em></li>
        <li><code>$presenter->showData('001', 'Alice', 'Computer Science', 3)</code> &rarr; <em><?= h($presenter->showData('001', 'Alice', 'Computer Science', 3)) ?></em></li>
      </ul>
    </div>
  </section>

  <script>
  const type = document.getElementById('type'),
    discountField = document.getElementById('discount-field'),
    partnerField = document.getElementById('partner-field');

  function sync() {
    discountField.style.display = type.value === 'scholarship' ? 'block' : 'none';
    partnerField.style.display = type.value === 'exchange' ? 'block' : 'none';
  }
  type.addEventListener('change', sync);
  sync();
  </script>
</body>

</html>
