<footer class="footer">
    <div class="container-fluid d-flex justify-content-between">
        <span class="text-muted d-block text-center text-sm-start d-sm-inline-block">Copyright © CRM Portal
            2023</span>
        <span class="float-none float-sm-end mt-1 mt-sm-0 text-end"> <a href="https://hostcry.com/"
                target="_blank">Developed</a> By
            Hostcry.com</span>
    </div>
</footer>

<!-- Notification Modal -->
<div class="modal fade" id="notificationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="noti_body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    async function openNotificationModal(data) {
        let heading = data.data.heading;
        let notification = data.data.notification;
        let noti_id = data.id;


        document.getElementById('exampleModalLabel').innerHTML = heading;
        document.getElementById('noti_body').innerHTML = notification;

        let res = await fetch('/notifications/' + noti_id + '/mark-as-read', {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}' // Add your CSRF token here
            }
        });
        res = await res.text();
        console.log(res);
    }
</script>
