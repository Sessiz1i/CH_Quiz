<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-danger">
            <div class="modal-header">
                <h5 class="modal-title">Quiz Silme Onayı</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('admin.quizzes.destroy','test')}}" method="post">
                @csrf @method('delete')
                <div class="modal-body ">
                    <h5 class="text-center">
                        <strong>Bu Quiz'i silmek istediğinizden emin misiniz?</strong>
                    </h5>
                    <input type="hidden" name="id" id="delid">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">Hayır, Kapat</button>
                    <button type="submit" class="btn btn-warning">Evet, Sil</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    /* Modal Script Delete */
    $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var modal = $(this)
        modal.find('.modal-body #delid').val(id);
    })
</script>

