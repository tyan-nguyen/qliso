<div class="col-md-12">
<?= $model->getAttributelabel('code') ?>: <strong><?= $model->code ?></strong>
</div>
<div class="col-md-12">
<?= $model->getAttributelabel('date_exam') ?>: <strong><?= $model->dateExam ?></strong>
</div>
<div class="col-md-12">
<?= $model->getAttributelabel('date_created') ?>: <strong><?= $model->dateCreated ?></strong>
</div>
<div class="col-md-12">
<?= $model->getAttributelabel('user_created') ?>: <strong><?= $model->userCreated ?></strong>
</div>
<div class="col-md-12">
<?= $model->workingExamination->getAttributelabel('name') ?>: <strong><?= $model->workingExamination->name ?></strong>
</div>
<div class="col-md-12">
<?= $model->workingRoom->getAttributelabel('room_name') ?>: <strong><?= $model->workingRoom->room_name ?></strong>
</div>
<div class="col-md-12">
<?= $model->workingRoom->roomParent->getAttributelabel('room_name') ?>: <strong><?= $model->workingRoom->roomParent->room_name ?></strong>
</div>