<?php $this->load->view('common/header'); ?>

<!-- Start Bradcaump area -->
<div class="ht__bradcaump__area">
    <div class="ht__bradcaump__container py-60">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1>FAQ</h1>
                    <nav class="bradcaump-inner">
                        <a class="breadcrumb-item" href="<?= base_url(); ?>">Home</a>
                        <span class="brd-separetor">/</span>
                        <span class="breadcrumb-item active">FAQ</span>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Bradcaump area -->

<!-- Start FAQ Area -->
<section class="faq__area py-80 bg--white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="section-title text-center mb-50">
                    <h2>Frequently Asked Questions</h2>
                    <p class="text-center">Find answers to the most common questions about Harvest Green Montessori.</p>
                </div>

                <?php if (!empty($faqs)): ?>
                <div class="panel-group" id="faqAccordion" role="tablist" aria-multiselectable="true">
                    <?php foreach ($faqs as $i => $row): ?>
                    <div class="panel panel-default" style="margin-bottom:10px; border-radius:6px; overflow:hidden; border:1px solid #e0e0e0;">
                        <div class="panel-heading" role="tab" id="faqHeading<?= $i; ?>" style="background:<?= htmlspecialchars($row->faq_bg_color ?? '#f7f7f7', ENT_QUOTES, 'UTF-8'); ?>; padding:0;">
                            <h4 class="panel-title">
                                <a role="button"
                                   data-toggle="collapse"
                                   data-parent="#faqAccordion"
                                   href="#faqCollapse<?= $i; ?>"
                                   aria-expanded="<?= $i === 0 ? 'true' : 'false'; ?>"
                                   aria-controls="faqCollapse<?= $i; ?>"
                                   style="display:block; padding:15px 20px; color:<?= htmlspecialchars($row->faq_title_color ?? '#3d3d3d', ENT_QUOTES, 'UTF-8'); ?>; text-decoration:none; font-weight:600;">
                                    <span class="fa fa-question-circle mr-2"></span>
                                    <?= htmlspecialchars($row->faq_question, ENT_QUOTES, 'UTF-8'); ?>
                                    <span class="fa fa-chevron-down pull-right" style="margin-top:3px; font-size:12px;"></span>
                                </a>
                            </h4>
                        </div>
                        <div id="faqCollapse<?= $i; ?>"
                             class="panel-collapse collapse <?= $i === 0 ? 'in' : ''; ?>"
                             role="tabpanel"
                             aria-labelledby="faqHeading<?= $i; ?>">
                            <div class="panel-body" style="padding:15px 20px; line-height:1.7; color:#555;">
                                <?= $row->faq_answer; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php else: ?>
                <div class="text-center py-40">
                    <p>No FAQs available at the moment. Please check back later.</p>
                </div>
                <?php endif; ?>

                <div class="text-center mt-40">
                    <p>Still have questions? <a href="<?= base_url(); ?>contact" class="text-success"><strong>Contact us</strong></a> and we will be happy to help.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End FAQ Area -->

<?php $this->load->view('common/footer'); ?>
