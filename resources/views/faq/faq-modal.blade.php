<div class="modal fade" id="faqModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="faq_id" data-modal="faqModal" action="{{ route('faq.store') }}" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Faqs</h5>
                    <button type="button" class="close modal-close-btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="mediumBody">
                    <div>
                        @csrf
                        <input type="hidden" name="id" value="">
                        <div class="col-md-8">
                            <label>Question</label>
                            <input type="text" name="question" class="form-control" validate
                                data-required-error="Question field is required." value="" />
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-md-8">
                            <label>Answer</label>
                            <input type="text" name="answer" class="form-control" validate
                                data-required-error="Answer field is required." value="" />
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="mt-2 pull-right">
                        <button type="button" class="btn btn-primary modal-close-btn"
                            data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary submit-btn"> Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
