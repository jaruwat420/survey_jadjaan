<div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
    <div class="fp_dashboard_body fp__change_password">
        <div class="fp__review_input">
            <h3>เปลี่ยนรหัสผ่าน</h3>
            <div class="comment_input pt-0">
                <form action="{{ route('profile.password.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="fp__comment_imput_single">
                                <label>รหัสผ่านเดิม</label>
                                <input type="password" placeholder="รหัสผ่านเดิม" name="current_password">
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="fp__comment_imput_single">
                                <label>รหัสผ่านใหม่</label>
                                <input type="password" placeholder="รหัสผ่านใหม่" name="password">
                            </div>
                        </div>
                        <div class="col-xl-12">
                            <div class="fp__comment_imput_single">
                                <label>ยืนยันรหัสผ่านใหม่</label>
                                <input type="password" placeholder="ยืนยันรหัสผ่านใหม่" name="password_confirmation">
                            </div>
                            <button type="submit" class="common_btn mt_20">ตกลง</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
