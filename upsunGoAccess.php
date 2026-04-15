#!/usr/bin/env php
<?php
/*
 * Upsun HTTP log + GoAccess helper — derivative of platformsh-analytics.
 * Original authors: Pixelant — https://github.com/pixelant/platformsh-analytics
 * Fork: Karsh Hagan Madden — https://github.com/maddenmedia/upsun-analytics
 * Modified for Upsun CLI and related fixes: 2026-04-14 (see CHANGELOG.md).
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version. See LICENSE.
 */

echo "\n";
echo ' _   _ ____  ____  _   _ _   _ ' . "\n";
echo '| | | / ___||  _ \| | | | \ | |' . "\n";
echo '| | | \___ \| |_) | | | |  \| |' . "\n";
echo '| |_| |___) |  __/| |_| | |\  |' . "\n";
echo ' \___/|____/|_|    \___/|_| \_|' . "\n";
echo str_repeat(' ', 12) . '- A N A L Y Z E R -' . "\n";
echo "\n";

if (!isset($argv[1])) {
    exec('upsun projects --format=csv --no-header --count=0', $projectOutput);

    $upsunProjects = [];
    foreach ($projectOutput as $row) {
        $upsunProjects[] = str_getcsv($row, ',', '"', '\\');
    }

    echo 'Available Upsun projects:' . "\n";

    for ($i = 0; $i < count($upsunProjects); $i++) {
        echo '    [' . ($i+1) . ']  ' . $upsunProjects[$i][1] . ' (' . $upsunProjects[$i][0] . ')' . "\n";
    }

    do {
        $selectedProjectNumber = (int) readline('Enter a project number > ');

        if (isset($upsunProjects[$selectedProjectNumber-1])) {
            $selectedProject = $upsunProjects[$selectedProjectNumber-1];
            break;
        } else {
            echo 'ERROR: Invalid project number. Please try again.' . "\n";
        }
    } while (true);
    
    echo "\n";
    echo $selectedProject[1] . ' was selected.' . "\n\n";
} else {
    exec('upsun project:info title --format=csv --no-header --project=' . escapeshellarg($argv[1]), $projectTitle);
    $selectedProject[0] = $argv[1];
    $selectedProject[1] = $projectTitle[0];
}

if (!isset($argv[2])) {
    exec('upsun environment:list --format=csv --no-header --project=' . escapeshellarg($selectedProject[0]), $environmentOutput);

    $upsunEnvironments = [];
    foreach ($environmentOutput as $row) {
        $upsunEnvironments[] = str_getcsv($row, ',', '"', '\\');
    }

    echo 'Available Upsun environments:' . "\n";

    for ($i = 0; $i < count($upsunEnvironments); $i++) {
        echo '    [' . ($i+1) . ']  ' . $upsunEnvironments[$i][1] . ' (' . $upsunEnvironments[$i][0] . ')' . "\n";
    }

    do {
        $selectedEnvironmentNumber = (int) readline('Enter a environment number > ');

        if (isset($upsunEnvironments[$selectedEnvironmentNumber-1])) {
            $selectedEnvironment = $upsunEnvironments[$selectedEnvironmentNumber-1];
            break;
        } else {
            echo 'ERROR: Invalid environment number. Please try again.' . "\n";
        }
    } while (true);
} else {
    $selectedEnvironment[0] = $argv[2];
}

if (!isset($argv[3])) {
    echo "\n";
    echo 'Please choose the number of lines to fetch:' . "\n";
    echo '    [1] 5000' . "\n";
    echo '    [2] 20000' . "\n";
    echo '    [3] Max' . "\n";

    do {
        $lineSelection = (string)readline('Please select (default: [2]) > ');

        if (in_array($lineSelection, ['1', '2', '3', ''], true)) {
            switch ($lineSelection) {
                case '1':
                    $numberOfLines = '5000';
                    break 2;
                case '2':
                    $numberOfLines = '20000';
                    break 2;
                case '3':
                default:
                    $numberOfLines = '999999';
                    break 2;
            }
        } else {
            echo 'ERROR: Invalid option. Please try again.' . "\n";
        }
    } while (true);
    echo "\n";
} else {
    $numberOfLines = $argv[3];
}

echo 'Getting the log... ' . "\n";
exec('upsun log -q --lines=' . escapeshellarg($numberOfLines) . ' --project=' . escapeshellarg($selectedProject[0]) . ' --environment=' . escapeshellarg($selectedEnvironment[0]) . ' access | goaccess --log-format="COMBINED" --html-prefs=\'{"theme":"bright"}\' -', $goaccessOutput);

$fileName = preg_replace('/\\s+/', '_', preg_replace("/[^A-Za-z0-9]/", '', $selectedProject[1])) . '-goaccess-' .date('YmdHis') . '.html';
file_put_contents($fileName, implode("\n", $goaccessOutput));

echo 'Statistics written to: ' . $fileName . "\n";