   <?php


    function addNoteIteam($databass, $id, $note, $header)
    {
        try{
            $update = $databass->prepare("UPDATE `shop` SET `NOTE` = :note WHERE ID = :id");
            $update->bindParam("id", $id);
            $update->bindParam("note", $note);
            $update->execute();

            // Refresh the page
            header('Location:'.$header);
            exit(); // Ensure no further code is executed after the redirect
            return True;
        }catch(PDOException $e){
            echo $e->getMessage();
            return False;
        }
    }

    function delateIteam($databass, $id , $header)
    {
        try{
            $delete = $databass->prepare("DELETE FROM `shop` WHERE ID = :id");
            $delete->bindParam("id", $id);
            $delete->execute();

            // Refresh the page
            header('Location:'.$header);
            exit(); // Ensure no further code is executed after the redirect
            return True;
        }catch(PDOException $e){
            echo $e->getMessage();
            return False;
        }
    }


    function addItem($databass, $number, $succesMessage = null, $werningMessage=null) {
        try {
            // تحقق من وجود الرقم مسبقًا
            $check = $databass->prepare("SELECT NUMBER FROM shop WHERE NUMBER = :id");
            $check->bindParam('id', $number, PDO::PARAM_STR);
            $check->execute();
    
            if ($check->rowCount() > 0) {
                // العنصر موجود مسبقًا
                return [
                    'status' => 'warning',
                    'message' => $werningMessage ?? 'Already Sent' // استخدم الرسالة المخصصة إذا تم تمريرها
                ];
            } else {
                // إضافة العنصر
                $addItem = $databass->prepare("INSERT INTO `shop`(`NUMBER`, `STATA`) VALUES (:id, 'IN LAP')");
                $addItem->bindParam('id', $number, PDO::PARAM_STR);
                if ($addItem->execute()) {
                    // الإضافة تمت بنجاح
                    return [
                        'status' => 'success',
                        'message' => $succesMessage ?? 'Sent Successfully' // استخدم الرسالة المخصصة إذا تم تمريرها
                    ];
                } else {
                    // خطأ أثناء الإضافة
                    return [
                        'status' => 'error',
                        'message' => implode(', ', $addItem->errorInfo())
                    ];
                }
            }
        } catch (Exception $e) {
            // معالجة الخطأ العام
            return [
                'status' => 'error',
                'message' => $e->getMessage()
            ];
        }
    }
    
    
    function viewIteam($results, $date) {
        // تحويل النتيجة من PDOStatement إلى مصفوفة
        $rows = $results->fetchAll(PDO::FETCH_ASSOC);
    
        if ($rows && count($rows) > 0) {
            foreach ($rows as $row) {
                echo '<tr class="table-light">
                        <td>' . $row["ID"] . '</td>
                        <td>' . $row["NUMBER"] . '</td>
                        <td>' . $row[$date] . '</td>
                        <td class="table-wrning">' . $row["STATA"] . '</td>
                        <td>
                            <form>
                                <button name="delet" class="btn btn-error" value="' . $row["ID"] . '">Delete</button>
                            </form>
                        </td>
                        <td>';
                if ($row["NOTE"] != null) {
                    echo '<form>
                            <div class="input-group">
                                <input class="form-control" type="text" value="' . $row["NOTE"] . '" readonly >
                                <button name="add" class="btn btn-wern" value="' . $row["ID"] . '">Edit</button>
                            </div>
                          </form>';
                } else {
                    echo '<form>
                            <div class="input-group">
                                <input class="form-control" type="text"  name="note"  placeholder="Add Note" >
                                <button name="add" class="btn btn-wern" value="' . $row["ID"] . '">Note</button>
                            </div>
                          </form>';
                }
                echo '</td></tr>';
            }
           
        } else {
            echo '<div class="alert alert-warning" role="alert">Not Found</div>';
        }
        echo '</table>';
    }
    