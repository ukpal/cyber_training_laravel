if($('.datatbl').length > 0) {
  $('.datatbl').DataTable({
    responsive: true,
    language: {
      searchPlaceholder: 'Search...',
      sSearch: '',
    }
  });
}

// $(".assign-task-btn").click(function(){
//   console.log('hi')
// })