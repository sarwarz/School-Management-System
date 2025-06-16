<!DOCTYPE html>
<html>
<head>
    <title>Academic Transcript</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h2, h3 {
            text-align: center;
            margin: 0;
        }

        .student-info, .transcript-table {
            width: 98%;
            border-collapse: collapse;
            margin-top: 40px;
        }

        .student-info td {
            padding: 6px;
        }

        .transcript-table th, .transcript-table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }

        .footer {
            width: 100%;
            margin-top: 60px;
        }

        .headmaster-signature {
            text-align: right;
            margin-top: 40px;
            float:right;
        }

        .headmaster-signature hr {
            width: 200px;
            float:right;
        }

    </style>
</head>
<body>

    <h2>Your School Name</h2>
    <h3>Academic Transcript</h3>

    <table class="student-info">
        <tr>
            <td><strong>Student ID:</strong> {{ $student->student_id }}</td>
            <td><strong>Name:</strong> {{ $student->first_name }} {{ $student->last_name }}</td>
        </tr>
        <tr>
            <td><strong>Father Name:</strong> {{ $student->father_name }}</td>
            <td><strong>Mother Name:</strong> {{ $student->mother_name }}</td>
        </tr>
        <tr>
            <td><strong>Date of Brith:</strong> {{ $student->date_of_birth }}</td>
            <td><strong>Roll No:</strong> {{ $student->roll_no }}</td> 
        </tr>
        <tr>
            <td><strong>Class:</strong> {{ $student->class->name ?? 'N/A' }}</td>
            <td><strong>Exam Type:</strong> {{ $student->marks->first()?->examType?->name ?? 'N/A' }}</td>
        </tr>
    </table>

    <table class="transcript-table">
        <thead>
            <tr>
                <th>Sl. No.</th>
                <th>Name of Subject</th>
                <th>Mark</th>
                <th>Grade Point</th>
                <th>Later Grade</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($student->marks as $key => $mark)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td style="text-align:left;">{{ $mark->subject->name ?? 'N/A' }}</td>
                <td>{{ $mark->mark }}</td>
                <td>{{ $mark->point }}</td>
                <td>{{ $mark->grade }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="2">Total</th>
                <td>{{ $student->marks->sum('mark') }}</td>
                <td colspan="2"></td>
            </tr>
            <tr>
                <th colspan="2">GPA</th>
                <td>{{ $student->gpa }}</td>
                <td colspan="2"></td>
            </tr>
            <tr>
                <th colspan="2">Final Grade</th>
                <td>{{ $student->grade_data->name ?? 'N/A' }}</td>
                <td colspan="2">{{ $student->grade_data->remarks ?? '' }}</td>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        <div class="headmaster-signature">
            <hr>
            <p>Headmaster Signature</p>
        </div>
    </div>

</body>
</html>
