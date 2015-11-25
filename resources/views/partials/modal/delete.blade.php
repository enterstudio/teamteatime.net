<div id="{{ "delete-item-{$item->id}" }}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Are you sure?</h4>
            </div>
            <div class="modal-body">
                <p>You are about to delete '{{ $item->name }}'! This process cannot be undone.</p>
                <p>Are you sure you wish to continue?</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" data-dismiss="modal">No</button>
                <a class="btn btn-success" data-route="{{ $item->deleteRoute }}" data-method="DELETE">Yes</a>
            </div>
        </div>
    </div>
</div>
