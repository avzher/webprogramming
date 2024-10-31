<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Accounts</h4>
            </div>
        </div>
    </div>
    <div class="modal-container"></div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <?php
                            require_once '../classes/account.class.php'; 
                            session_start();
                            $accountObj = new Account();
                        ?>
                        <div class="page-title-right d-flex align-items-center"> 
                           
                        </div>
                    </div>
                    
                    <div class="table-responsive">
                        <table id="accounts-table" class="table table-centered table-nowrap mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-start">Lastname</th>
                                    <th>Firstname</th>
                                    <th>Username</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                $accounts = $accountObj->getAllAccounts();

                                foreach ($accounts as $account) {
                                ?>
                                    <tr>
                                        <td class="text-start"><?= $account['last_name'] ?></td>
                                        <td><?= $account['first_name'] ?></td>
                                        <td><?= $account['username'] ?></td>
                                        <td><?= $account['role'] ?></td>
                                        <td class="text-nowrap">
                                            <a href="../accounts/editaccount.php?id=<?= $account['id'] ?>" class="btn btn-sm btn-outline-success me-1">Edit</a>
                                            <?php if (isset($_SESSION['account']['is_admin']) && $_SESSION['account']['is_admin']) { ?>
                                                <button class="btn btn-sm btn-outline-danger deleteBtn" data-id="<?= $account['id'] ?>" data-name="<?= htmlspecialchars($account['username']) ?>">Delete</button>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php
                                    $i++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>