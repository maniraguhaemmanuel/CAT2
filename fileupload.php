<?php
 require 'db.php';
if (isset($_POST['import']))
	{
        $filename =$_FILES["file"]['tmp_name'];
        if($_FILES["file"]['size']>0)
        {
            $file = fopen($filename, "r");

            while (($data = fgetcsv($file, 1000, ",")) !== FALSE)
            {
                $sql = 'INSERT INTO tenant(name, email,phone_number,national_id,house_kind) VALUES(:name, :email,:phone_number,:national_id,:house_kind)';
                $statement = $connection->prepare($sql);
                $statement->execute([':name' => $data[0], ':email' => $data[1], ':phone_number' => $data[2], ':national_id' => $data[3], ':house_kind' => $data[4]]);
            }
            fclose($file);
            header("Location: index.php");
        }
        else
        {
            echo "File Size not Suported";
        }
	
 
	}
 
?>