

function toggleAddForm() {
    var addForm = document.querySelector('.add-form');
    addForm.style.display = (addForm.style.display === 'none' || addForm.style.display === '') ? 'block' : 'none';
}
function toggleUpdate() {
    var addForm = document.querySelector('.dv-update');
    addForm.style.display = (addForm.style.display === 'none' || addForm.style.display === '') ? 'block' : 'none';
}


function addUserAccount() {
    var usernameToAdd = document.getElementById('new-username').value;
    // Add additional validation if needed
    if (confirm('Are you sure you want to add the account for ' + usernameToAdd + '?')) {
        // You may want to submit the form here if needed
        document.querySelector('.add-form form').submit();
        // For now, let's assume the form will be submitted in the HTML
    } else {
        // Handle the case where the user cancels the operation
        alert('Add user operation canceled.');
    }
}



function toggleDeleteForm() {
        var deleteForm = document.querySelector('.delete-form');
        deleteForm.style.display = (deleteForm.style.display === 'none' || deleteForm.style.display === '') ? 'block' : 'none';
    }

    // Add this JavaScript function to handle the deletion
    function deleteUserAccount() {
        var usernameToDelete = document.getElementById('delete-username').value;
        // Add additional validation if needed
        if (confirm('Are you sure you want to delete the account for ' + usernameToDelete + '?')) {
            // You may want to submit the form here if needed
            document.querySelector('.delete-form form').submit();
            // For now, let's assume the form will be submitted in the HTML
        } else {
        // Handle the case where the user cancels the operation
        alert('Delete user operation canceled.');
    }
    }









    function addDV() {
        var dvtoAdd = document.getElementById('TenDichVu').value;
        // Add additional validation if needed
        if (confirm('Are you sure you want to add for ' + dvtoAdd + '?')) {
            // You may want to submit the form here if needed
            document.querySelector('.add-form form').submit();
            // For now, let's assume the form will be submitted in the HTML
        } else {
            // Handle the case where the user cancels the operation
            alert('Add operation canceled.');
        }
    }







    function toggleUpdateForm() {
        var updateForm = document.querySelector('.update-form');
        updateForm.style.display = (updateForm.style.display === 'none' || updateForm.style.display === '') ? 'block' : 'none';
    }
    
    function openUpdateForm(maDichVu, tenDichVu, anh, moTaDichVu, donGiaDichVu) {
        var updateForm = document.querySelector('.update-form');
        var updateMaDichVu = document.getElementById('updateMaDichVu');
        var updateTenDichVu = document.getElementById('updateTenDichVu');
        var updateAnh = document.getElementById('updateAnh');
        var updateMoTaDichVu = document.getElementById('updateMoTaDichVu');
        var updateDonGiaDichVu = document.getElementById('updateDonGiaDichVu');
    
        updateMaDichVu.value = maDichVu;
        updateTenDichVu.value = tenDichVu; 
        updateAnh.value = anh;
        updateMoTaDichVu.value = moTaDichVu;
        updateDonGiaDichVu.value = donGiaDichVu;
    
        toggleUpdateForm();
    }
    

    