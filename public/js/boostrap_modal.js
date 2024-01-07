$(function() {

  $('#edit').click(function () {
    alert('dd');
    // $('#btn-save').val("create-customer");
    // $('#customer').trigger("reset");
    // $('#customerCrudModal').html("Add New Customer");
    $('#editModal').modal('show');
    });
    // $('#editModal').on('show.bs.modal', function(e) {
    //   alert('ddd');
    //   $('.modalTextInput').val('');
    //   let btn = $(e.relatedTarget); // e.related here is the element that opened the modal, specifically the row button
    //   let id = btn.data('id'); // this is how you get the of any `data` attribute of an element
    //   $('.saveEdit').data('id', id); // then pass it to the button inside the modal
    // });
  
    // $('.saveEdit').on('click', function() {
    //   let id = $(this).data('id'); // the rest is just the same
    //   saveNote(id);
    //   $('#exampleModal').modal('toggle'); // this is to close the modal after clicking the modal button
    // })
  });