<?php
    $language = strtolower($_POST['language']);
    $code = $_POST['code'];

    $random = substr(md5(mt_rand()), 0, 7);
    $filePath = "temp/" . $random . "." . $language;
    $programFile = fopen($filePath, "w");
    fwrite($programFile, $code);
    fclose($programFile);

    
    if($language == "py") {
        $output = shell_exec("C:\Users\Snehil\AppData\Local\Programs\Python\Python39\python.exe $filePath 2>&1");
        // $output = shell_exec("C:\Users\KOUSIK\AppData\Local\Programs\Python\Python39\python.exe $filePath 2>&1");
        echo $output;
    }

    if($language == "cpp") {
        // $compileCommand = "C:\MinGW\bin $filePath -o $outputExe 2>&1";
        // $compileOutput = shell_exec($compileCommand);
        // shell_exec("C:\\MinGW\\bin\\g++ $filePath -o $outputExe 2>&1");
        $outputExe = $random . ".exe";
        $compileOutput = shell_exec("C:\\MinGW\\bin\\g++ $filePath -o $outputExe 2>&1");
        if (!empty($compileOutput)) {
            echo "Compilation Error: <pre>$compileOutput</pre>";
        } else {
            // Continue with code execution
            $output = shell_exec(__DIR__ . "/$outputExe 2>&1");
            echo $output;
        }


        // $outputExe = $random . ".exe";
        // shell_exec("g++ $filePath -o $outputExe");
        // $output = shell_exec(__DIR__ . "//$outputExe");
        // echo $output;
    }