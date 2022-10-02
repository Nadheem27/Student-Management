$(function () {

    function editButton(route) {
        return '<a href="'+ route +'" class="btn btn-sm btn-outline-primary">Edit</a>'
    }

    function deleteButton(fn) {
        return '<button type="button" class="btn btn-sm btn-outline-danger" onclick="'+ fn +'" >Delete</button>'
    }

    function deleteStudent(id) {
        if(confirm('Are you sure, you want to delete Student ??'))
        {
            $.ajax({
                type: "POST",
                url: DATATABLE.delete_url,
                data : { id : id, _token : $('meta[name="_token"]').attr('content') },
                success: function(result) {
                    switch(result.code) {
                        case 0:
                            flasher.success(result.message);
                            $('#students_table').DataTable().destroy();
                            loadStudentsTable();
                            break;

                        case 1:
                            flasher.error(result.message);
                            break;
                    }
                }
            });   
        }            
    }

    function deleteMark(id) {
        if(confirm('Are you sure, you want to delete Record ??'))
        {
            $.ajax({
                type: "POST",
                url: DATATABLE.delete_url,
                data : { id : id, _token : $('meta[name="_token"]').attr('content') },
                success: function(result) {
                    switch(result.code) {
                        case 0:
                            flasher.success(result.message);
                            $('#marks_table').DataTable().destroy();
                            loadMarksTable();
                            break;

                        case 1:
                            flasher.error(result.message);
                            break;
                    }
                }
            });   
        }     
    }

    if ($('#students_table').length > 0)
        loadStudentsTable();

    function loadStudentsTable()
    {
        $('#students_table').DataTable({
            lengthMenu: [10, 25, 50, 100, 500],
            serverSide: true,
            processing: true,
            ordering: false,
            autoWidth: false,           
            ajax: DATATABLE.ajax_url,
            columns: [
                {
                    render: function (data, type, full) {
                        return full.id;
                    },
                },
                {
                    render: function (data, type, full) {
                        return full.name;
                    },
                },
                {
                    render: function (data, type, full) {
                        return full.age;
                    },
                },
                {
                    render: function (data, type, full) {                        
                        return full.gender;
                    },
                },
                {
                    render: function (data, type, full) {                        
                        return full.teacher;
                    },
                },
            ],
            columnDefs: [
                {
                    targets: 5,
                    visible: true,
                    render: function (data, type, full) { 
                        return editButton(full.edit)+'&nbsp'+deleteButton(full.delete);
                    },
                },
            ],
        });
    }

    if($('#marks_table').length > 0)
        loadMarksTable()

    function loadMarksTable() {

        $('#marks_table').DataTable({
            lengthMenu: [10, 25, 50, 100, 500],
            serverSide: true,
            processing: true,
            ordering: false,
            autoWidth: false,           
            ajax: DATATABLE.ajax_url,
            columns: [
                {
                    render: function (data, type, full) {
                        return full.id;
                    },
                },
                {
                    render: function (data, type, full) {
                        return full.name;
                    },
                },
                {
                    render: function (data, type, full) {
                        return full.maths;
                    },
                },
                {
                    render: function (data, type, full) {                        
                        return full.science;
                    },
                },
                {
                    render: function (data, type, full) {                        
                        return full.history;
                    },
                },
                {
                    render: function (data, type, full) {                        
                        return full.term;
                    },
                },
                {
                    render: function (data, type, full) {                        
                        return full.total;
                    },
                },
                {
                    render: function (data, type, full) {                        
                        return full.created;
                    },
                },
            ],
            columnDefs: [
                {
                    targets: 8,
                    visible: true,
                    render: function (data, type, full) { 
                        return editButton(full.edit)+'&nbsp'+deleteButton(full.delete);
                    },
                },
            ],
        });
    }
    
    window.deleteStudent = deleteStudent; 
    window.deleteMark = deleteMark; 
});