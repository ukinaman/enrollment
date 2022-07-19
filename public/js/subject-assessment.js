// Handles check all on student-subjects component
$(document).ready(function() {
    $('#checkAll').click(function() {
        var checked = this.checked;
        $('.check-subject[type="checkbox"]').each(function() {
            this.checked = checked;
        });
    })
});