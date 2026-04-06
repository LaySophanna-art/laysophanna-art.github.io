<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BBU Grading System</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .title {
            color: blue;
            font-family: Khmer OS Muol Light;
            text-align: center;
            background-color: darkblue;
            color: white;
            padding: 10px;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: left;
            justify-content: center;
            background-color: lightgray;
            width: 60%;
            margin-left: 20%;
            padding: 10px;
            border-radius: 10px;
        }

        label {
            font-family: Khmer OS Siemreap;
            font-weight: bold;
            color: darkblue;
        }

        input {
            height: 30px;
            padding: 8px;
            border-radius: 10px;
            border-style: solid;
            border-color: lightgray;
            border-width: 2px;
        }

        .buttons {
            width: 100%;
            gap: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-Clear {
            font-family: Khmer OS Siemreap;
            width: 50%;
            padding: 6px;
            border-style: solid;
            border-color: white;
            background-color: white;
            border-radius: 10px;
            font-weight: bold;
            font-size: small;
            height: 40px;
        }

        .btn-Calculate {
            font-family: Khmer OS Siemreap;
            width: 50%;
            padding: 6px;
            color: white;
            border-style: solid;
            border-color: darkblue;
            background-color: darkblue;
            border-radius: 10px;
            font-weight: bold;
            font-size: small;
            height: 40px;
        }

        .result {
            background-color: darkblue;
            font-family: Khmer OS Siemreap;
            width: 61.6%;
            text-align: center;
            margin-left: 20%;
            color: white;
            border-radius: 10px;
        }

        .footer {
            margin-top: 20px;
            font-family: Arial, Helvetica, sans-serif;
            background-color: black;
            color: white;
            padding: 1px;
            text-align: center;
        }
    </style>
</head>

<body>
    <header>
        <h2 class="title">សាកលវិទ្យាល័យបៀលប្រាយ </h2>
    </header>

    <main>
        <section>
            <form action="" method="post">

                <label for="Student-name"> ឈ្មោះសិស្ស </label><br>
                <input type="text" name="Student-name" id="Student-name" placeholder="Enter your name" required maxlength="20"><br><br>

                <label for="Attendants"> វត្តមាន </label><br>
                <input type="number" name="Attendants" id="Attendants" placeholder="Enter your attendants amount" minlength="0" maxlength="2"><br><br>

                <label for="Midterm"> ពិន្ទុ Mid-term </label><br>
                <input type="number" name="Midterm" id="Midterm" placeholder="Enter your Mid-term score" minlength="0" maxlength="2"><br><br>

                <label for="Final"> ពិន្ទុ Final </label><br>
                <input type="number" name="Final" id="Final" placeholder="Enter your final score" minlength="0" maxlength="2"><br><br>

                <div class="buttons">
                    <button type="Reset" class="btn-Clear">សម្អាត</button>
                    <button type="Submit" class="btn-Calculate">គណនា</button>
                </div>
            </form>
        </section>

        <section>
            <div class="result">
                <h2>លទ្ធផល</h2>
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {

                    $name       = $_POST['Student-name'] ?? '';
                    $attendants = (int)($_POST['Attendants'] ?? 0);
                    $midterm    = (int)($_POST['Midterm'] ?? 0);
                    $final      = (int)($_POST['Final'] ?? 0);

                    $total = $midterm + $final;

                    $message = "";
                    $grade   = "";

                    // === YOUR REQUESTED LOGIC (attendance decides first) ===
                    if ($attendants >= 16) {
                        $message = "Re-study (Too many absences)";
                    } elseif ($attendants >= 11 && $attendants <= 15) {
                        $message = "Re-exam (Attendance problem)";
                    } else {
                        // Attendants <= 10 → Allowed to take exam
                        $message = "Allowed to take exam";

                        if ($midterm < 20) {
                            $message = "Re-exam (Midterm below 20)";
                        } elseif ($total < 60) {
                            $message = "Re-exam (Total below 60)";
                        } else {
                            switch (true) {
                                case ($total >= 90):
                                    $grade = "A";
                                    break;
                                case ($total >= 80):
                                    $grade = "B";
                                    break;
                                case ($total >= 70):
                                    $grade = "C";
                                    break;
                                case ($total >= 60):
                                    $grade = "D";
                                    break;
                                default:
                                    $grade = "F";
                            }
                            $message = "Passed";
                        }
                    }

                    // Show scores + status (even if they failed because of attendance)
                    echo "<div style='color:black;background-color:lightgray;padding:15px;margin:10px;border-radius:8px;font-size:16px;'>";
                    echo "<b>Name:</b> " . htmlspecialchars($name) . "<br>";
                    echo "<b>Midterm Score:</b> $midterm <br>";
                    echo "<b>Final Score:</b> $final <br>";
                    echo "<b>Total Score:</b> $total <br>";
                    echo "<b>Status:</b> <span style='color:red;font-weight:bold;'>$message</span>";
                    echo "</div>";

                    // Only show grade if they actually PASSED (good attendance + good scores)
                    if ($grade != "") {
                        echo "<div style='background:darkblue;color:white;padding:15px;margin:10px;font-size:28px;font-weight:bold;text-align:center;border-radius:8px'>";
                        echo "Your grade is $grade";
                        echo "</div>";
                    }
                }
                ?>
            </div>
        </section>
    </main>

    <footer class="footer">
        <p>All right reserved &copy; by Lay SoPhanNa 2026</p>
    </footer>
</body>

</html>