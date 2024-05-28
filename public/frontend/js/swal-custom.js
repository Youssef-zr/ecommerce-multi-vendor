// swal fire
let swalFireMessage = (title = "", text = "", icon = "success", footer = "") => {
    Swal.fire({
        title,
        text,
        icon
    });
};

// swale options
let swalOptions = (title = 'Are you Sure!', text = null, icon = null, showCancelButton = true, confirmButtonColor = "#3085d6", cancelButtonColor = "#d33", confirmButtonText = null) => {
    return {
        title,
        text,
        icon,
        showCancelButton,
        confirmButtonColor,
        cancelButtonColor,
        confirmButtonText,
    }
}
