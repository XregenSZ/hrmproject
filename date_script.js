function calculateDateDifference() {
    var startDateString = document.getElementById("start_date").value;
    var endDateString = document.getElementById("end_date").value;

    // Parse dates
    var startDate = new Date(startDateString.replace(/-/g, '/'));
    var endDate = new Date(endDateString.replace(/-/g, '/'));

    // Calculate difference
    var differenceInTime = endDate.getTime() - startDate.getTime();
    var differenceInDays = differenceInTime / (1000 * 3600 * 24);

    if (!isNaN(differenceInDays)) {
        document.getElementById("result").innerText = "ต้องการลาจำนวน : " + differenceInDays + " วัน";
    } else {
        document.getElementById("result").innerText = "โปรดเลือกวันที่ต้องการลา";
    }
}
