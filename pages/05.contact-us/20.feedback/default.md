---
title: 'Gateway Feedback'
metadata:
    '''keywords''': help
    '''description''': help
main: false
---

### CADRE Gateway Feedback Form

If you've found a bug or have a feature suggestion for the CADRE Gateway, please let us know!  We rely on your feedback to 
make CADRE the very best research platform available.


<form  id="the_form" action="./feedback/process" method="POST" enctype="multipart/form-data">
<input type="text" id="username_field" name="username" placeholder="username">
<input type="hidden" value="gateway_feedback" name="form_name">
<div class="row">
<div class="form-group col-md-6">
<label for="Submission_Name">Name</label>
<input class="form-control" required="" type="text" id="Submission_Name" name="Submission_Name">
</div>
<div class="form-group col-md-6">
<label for="Submission_Email">Email</label>
<input class="form-control" required="" type="email" id="Submission_Email" name="Submission_Email">
</div>
<div class="form-group col-md-6">
<label for="Feedback_Type">Feedback Type</label>
<select name="Feedback_Type" id="Feedback_Type" required class="form-control">
    <option value="" disabled selected> -- Choose a feedback type -- </option>
    <option value="Bug_Report">Bug Report</option>
    <option value="Feature_Suggestion">Feature Suggestion</option>
    <option value="Help_Request">Help Request</option>
    <option value="Other">Other</option>
</select>
</div>
<div class="form-group col-md-6">
<label for="Institution">Institution <small class="text-muted">(Optional)</small></label>
<input class="form-control" type="text" id="Institution" name="Institution">
</div>
<div class="form-group col-12">
<label for="Question_or_Comment">Feedback Comment</label>
<textarea class="form-control" required="" name="Question_or_Comment" id="Question_or_Comment"></textarea>
</div>
</div>
<div class="row">
<div class="form-group col">
<input class="btn btn-primary" type="Submit" value="Submit Feedback Form">
</div>
</div>
</form>

