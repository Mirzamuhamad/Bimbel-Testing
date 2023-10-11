<!-- modal edit data -->
<div id="EditOlimpiade<?= $i ?>" class="modal fade" role="dialog">
    <div class="modal-dialog modal-XL">
        <!-- konten modal-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Olimpiade</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- body modal -->
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">

                    <?php
                    $OlimpiadeID = $isi['OlimpiadeID'];
                    $query = "SELECT msolimpiade.* ,msvenue.VenueName, msorganizer.OrganizerName FROM msolimpiade 
                                                             JOIN msvenue ON msvenue.VenueID = msolimpiade.venue
                                                             JOIN msorganizer ON msorganizer.OrganizerID = msolimpiade.Organizer 
                                                             WHERE OlimpiadeID= '$OlimpiadeID' ";
                    $query1 = mysqli_query($koneksi, $query);
                    $Edit = mysqli_fetch_array($query1);
                    ?>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="OlimpiadeID">Olimpiade ID</label>
                                <input type="Text" id="OlimpiadeID" name="OlimpiadeID" required class="form-control" autocomplete="off" value="<?= $Edit["OlimpiadeID"]; ?>">
                            </div>
                            <div class="form-group">
                                <label for="OlimpiadeName">Olimpiade Name</label>
                                <input type="Text" id="OlimpiadeName" name="OlimpiadeName" required class="form-control" autocomplete="off" value="<?= $Edit["OlimpiadeName"]; ?>">
                            </div>
                            <div class="form-group">
                                <label for="EligibleClassStart">Eligible Class
                                    Start</label>
                                <input type="Text" id="EligibleClassStart" name="EligibleClassStart" required class="form-control" autocomplete="off" value="<?= $Edit["EligibleClassStart"]; ?>">
                            </div>
                            <div class="form-group">
                                <label for="EligibleClassEnd">Eligible Class
                                    End</label>
                                <input type="Text" id="EligibleClassEnd" name="EligibleClassEnd" required class="form-control" autocomplete="off" value="<?= $Edit["EligibleClassEnd"]; ?>">
                            </div>
                            <div class="form-group">
                                <label for="EligibleAgeStart">Eligible Age
                                    Start</label>
                                <input type="Text" id="EligibleAgeStart" name="EligibleAgeStart" required class="form-control" autocomplete="off" value="<?= $Edit["EligibleAgeStart"]; ?>">
                            </div>
                            <div class="form-group">
                                <label for="EligibleAgeEnd">Eligible Age End</label>
                                <input type="Text" id="EligibleAgeEnd" name="EligibleAgeEnd" required class="form-control" autocomplete="off" value="<?= $Edit["EligibleAgeEnd"]; ?>">
                            </div>
                            <div class="form-group">
                                <label for="ExamDateStart">Exam Date Start</label>
                                <input type="Text" id="ExamDateStart" name="ExamDateStart" required class="form-control" autocomplete="off" value="<?= $Edit["ExamDateStart"]; ?>">
                            </div>
                            <div class="form-group">
                                <label for="ExamDateEnd">Exam Date End</label>
                                <input type="Text" id="ExamDateEnd" name="ExamDateEnd" required class="form-control" autocomplete="off" value="<?= $Edit["ExamDateEnd"]; ?>">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="RegistrationDate">Registration
                                    Date</label>
                                <input type="Text" id="RegistrationDate" name="RegistrationDate" required class="form-control" autocomplete="off" value="<?= $Edit["RegistrationDate"]; ?>">
                            </div>
                            <div class="form-group">
                                <label for="UrlImage">Url Image</label>
                                <input type="Text" id="UrlImage" name="UrlImage" required class="form-control" autocomplete="off" value="<?= $Edit["UrlImage"]; ?>">
                            </div>
                            <div class="form-group">
                                <label for="UrlImage2">Url Image 2</label>
                                <input type="Text" id="UrlImage2" name="UrlImage2" required class="form-control" autocomplete="off" value="<?= $Edit["UrlImage2"]; ?>">
                            </div>
                            <div class="form-group">
                                <label for="Price">Price</label>
                                <input type="Text" id="Price" name="Price" required class="form-control" autocomplete="off" value="<?= $Edit["Price"]; ?>">
                            </div>
                            <div class="form-group">
                                <label>Venue</label>
                                <input type="hidden" id="UpdatedBy" name="UpdatedBy" readonly="true" enabled="false" value="<?= $_SESSION['masuk']["AdminID"] ?>" required class="form-control" autocomplete="off">

                                <select id="Venue" name="Venue" class="form-control select2" data-placeholder="Pilih Venue" style="width: 100%;">
                                    <option selected="selected" value="<?= $Edit["Venue"]; ?>">
                                        <?= $Edit["VenueName"]; ?></option>

                                    <?php
                                    $venueQuery = "SELECT VenueID, VenueName FROM msVenue WHERE FgActive = 'Y'  ";
                                    $venueGetData = mysqli_query($koneksi, $venueQuery);
                                    while ($venue = mysqli_fetch_array($venueGetData)) {
                                    ?>
                                        <option value="<?= $venue["VenueID"]; ?>">
                                            <?= $venue["VenueName"]; ?> </option>
                                    <?php } ?>

                                </select>
                            </div>


                            <div class="form-group">
                                <label>Organizer</label>
                                <select id="Organizer" name="Organizer" class="form-control select2" data-placeholder="Pilih Organizer" style="width: 100%;">
                                    <option selected="selected" value="<?= $Edit["Organizer"]; ?>">
                                        <?= $Edit["OrganizerName"]; ?></option>
                                    <?php
                                    $OrganizerQuery = "SELECT OrganizerID, OrganizerName FROM msorganizer WHERE FgActive = 'Y' ";
                                    $OrganizerGetData = mysqli_query($koneksi, $OrganizerQuery);
                                    while ($Organizer = mysqli_fetch_array($OrganizerGetData)) {
                                    ?>
                                        <option value="<?= $Organizer["OrganizerID"]; ?>">
                                            <?= $Organizer["OrganizerName"]; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="FgActive">Fg Active</label>
                                <select id="FgActive" name="FgActive" class="form-control custom-select">
                                    <option selected=""><?= $Edit["FgActive"]; ?>
                                    </option>
                                    <option value="Y">Yes</option>
                                    <option value="N">No</option>
                                </select>
                            </div>
                        </div>
                    </div>
            </div>
            <!-- body modal finish -->
            <!-- footer modal -->
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"> <i class="fas fa-times"></i>
                    Close</button>
                <button type="submit" name="EditKwalifikasi" class="btn  btn-primary btn-sm"> <i class="fas fa-save"></i>
                    Save Edit Olimpiade</button>
            </div>

            </form>
        </div>
    </div>
</div>