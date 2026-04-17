<!-- Main Footer -->
<footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline"></div>
    <!-- Default to the left -->
    <strong>Copyright &copy; <?= date('Y') ?> <a href="http://arabinfotechllc.com/" target="_blank">arabinfotec</a>.</strong> All
    rights reserved.
</footer>
</div><!-- ./wrapper --><!-- Modal Alert Confirm-->
<div class="modal fade" id="alertModal" tabindex="-1" role="dialog" aria-labelledby="alertModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="alertModalTitle">&nbsp;</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="modalClose();">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="alertModalBody"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-redirect="" id="alertModalConfirmBtn">Confirm
                </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="modalClose();">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="deleteModalBody"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-redirect="" id="deleteModalConfirmBtn">Confirm
                </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</body>
<script>
    function modalClose() {
        $("#alertModal").modal('hide');
        $("#successModal").modal('hide');
    }
</script>

</html>