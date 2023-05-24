import Swal from "sweetalert2";

export const swalConfirmOptions = {
  title: "Are you sure?",
  text: "You won't be able to revert this!",
  icon: "warning",
  showCancelButton: true,
  confirmButtonColor: "#3085d6",
  cancelButtonColor: "#d33",
  confirmButtonText: "Yes, delete it!",
};

export const swalConfirm = (action) => {
  Swal.fire(swalConfirmOptions).then(action);
};
