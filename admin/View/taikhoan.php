<?php
include "./model/dungchung.php";
?>
<div class="content">
    <form action="#" method="post">
        <div class="content-item">
        <div class="table-container">
                <table class="account-table">
                    <thead>
                        <tr class="table-header">
                        <th class="dtt">STT</th>
                            <th class="user-id">User ID</th>
                            <th class="username">Username</th>
                            <th class="password">Password</th>
                            <th class="email">Email</th>
                            <th class="role">Role</th>
                            <th style="width: 15%">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search'])) {
                           
                            $searchKeyword = $_POST['search'];
                           
                            searchAccount($searchKeyword);
                        }else {
                           
                            displayUserData();
                        }

                         ?>
                    </tbody>
                </table>
            </div>
        </div> 
        <div class="action-buttons">
        <a href="#"><button type="button" class="btn-add" onclick="toggleAddForm()"><i class="fas fa-plus"></i> Add</button></a>
             <!-- Export Form -->
        <form action="#" method="post">
            <!-- <input type="hidden " name="exportReport"> -->
            <button type="submit" name="exportTaiKhoan" class="btn-xuat"><i class="fas fa-file-export"></i> Export</button>
        </form>
        <form action="#" method="post" class="forms_timkiem">
            <input type="text" id="searchInput" name="search" placeholder="Tìm kiếm">
            <button type="submit" class="btn-search"><i class="fas fa-search"></i></button>
        </form>

    
</div>


    
    <div class="add-form" style="display: none;">
    <div class="add-form-boder">
        <form action="#" method="post"> 
            <input placeholder="Username" type="text" id="new-username" name="username" required> <br>
            <input placeholder="Password" type="password" id="new-password" name="password" required><br>
            <input placeholder="Email" type="email" id="new-email" name="email" required><br>
            <input placeholder="Role (0 or 1)" type="number" id="new-role" name="role" min="0" max="1" required> <br>

           

            <button type="submit" class="btn-add-user" onclick="addUserAccount()"><i class="fas fa-plus"></i> ADD</button>
            <button type="button" class="btn-close" onclick="toggleAddForm()"><i class="fas fa-times"></i> EXIT</button>
        </form>
     </div>
    </div> 
    <!-- <div class="delete-form" style="display: none;">
    <div class="add-form-boder">
        <form action="#" method="post">
            <input placeholder="UserID" type="text" id="delete-username" name="delete-username" required>
         
            <button type="submit" class="btn-delete-user" onclick="deleteUserAccount()"><i class="fas fa-trash-alt"></i> Delete</button>
            <button type="button" class="btn-close" onclick="toggleDeleteForm()"><i class="fas fa-times"></i> Close</button>
        </form>
    </div>
    </div> -->

   
    <?php
    
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username'])) {
        
        if (!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['email']) && isset($_POST['role'])) {
            
            $nextUserID = getNextUserID();
            
            $newUsername = $_POST['username'];
            $newPassword = $_POST['password'];
            $newEmail = $_POST['email'];
            $newRole = $_POST['role'];
           
            addAccount($newUsername, $newPassword, $newEmail, $newRole);
        }

    }

    ?>

    <?php
     
     if (isset($_GET['UserID']))
     {
         $userID = $_GET['UserID'];
         deleteAccount($userID);
     }

    ?>
    <?php
        // Check if the export button is clicked
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['exportTaiKhoan'])) {
            // Call your export function here
            exportAccountTypeToExcel();
      }
    ?>
    </form>
</div>
