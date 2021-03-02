<section id="profile-main" class="grid-profile container mt-5">
    <div class="one">
        <h3 class="nickname my-4"><b>Joaquina123</b></h3>
        <div class="profile-pic col">
            <svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice">
                <rect width="100%" height="100%" fill="#777"></rect>
            </svg>
        </div>
    </div>
    <div class="two">
        <div class="row my-4">
            <section class="profile-info col">
                <h3>Personal Information</h3>
                <p><i class="fas fa-user"></i> Name: Maria Joaquina</p>
                <p><i class="fas fa-at"></i> E-mail: up201806230@fe.up.pt</p>
                <p><i class="fa fa-calendar" aria-hidden="true"></i> Birthday: 09/02/1997</p>
            </section>

            <section class="profile-about-me col">
                <h3>About Me</h3>
                <p>Hello! It's Joaquina! I'm currently studying Informatic Engineering (MIEIC) at FEUP. My dream is to work at google and become a great software engineer. I love dogs and cats, I hope I love you too.</p>
            </section>
        </div>
    </div>
    <div class="three">
        <section class="profile-academic-info">
            <h3>Academic Information</h3>
            <p><i class="fas fa-graduation-cap"></i> Course: MIEIC</p>
            <p><i class="fa fa-calendar" aria-hidden="true"></i> Current year: 3rd</p>
            <div>
                <span class="category tag badge bg-secondary"> 
                    <i class="fas fa-hashtag"></i>
                    MIPS
                </span>
                <span class="category tag badge bg-secondary">
                    <i class="fas fa-hashtag"></i>
                    COMP
                </span>
            </div>
        </section>
    </div>
</section>

<hr class="mt-5 container">

<section id="profile-questions" class="container mt-5">
    <h3 class="mb-4">My Questions</h3>
    <?php for($i = 0; $i < 2; $i++){ ?> 
        <article class="profile-question container my-4 border shadow rounded">
            <!-- Question Title -->
            <div class="row">
                <div class="col-2">
                    <h4>0 answers</h4>
                </div>

                <div class="d-flex align-items-center col">
                    <h2 class="card-title flex-grow-1"><a href="#">Should I learn MIPS?</a></h2> <!-- Question Title -->

                    <span class="category course badge rounded-pill bg-secondary">
                        <i class="fas fa-graduation-cap"></i>
                        MIEIC
                    </span>
                </div>
            </div>
            
            <div class="row">
                <section class="col-2 mt-5">
                    <span class="category tag badge bg-secondary"> 
                        <i class="fas fa-hashtag"></i>
                        MIPS
                    </span>
                    <span class="category tag badge bg-secondary">
                        <i class="fas fa-hashtag"></i>
                        COMP
                    </span>
                </section>

                <!-- Question Text -->
                <div class="question-content col">
                <p>Is the MIPS programming language that beneficial to know? I'm a CS student and am taking a assembly class which focuses on MIPS. I'm very comfortable writing in high level languages, but MIPS has me a little bit down. Is MIPS something that I should really focus on and try to completely grasp it? Will it help me in the future?</p>
                </div>
            </div>

            <!-- Question Date -->
            <section class="float-right">
                <img class="rounded-circle" src="images/profile.png" alt=""> <!-- Small Profile Image -->
                <div>
                    <span>Joaquina Almeida</span> <!-- Name -->
                    <span >15:02 - 10/05/2009</span> <!-- Date -->
                </div>
            </section>
        </article>
    <?php } ?>
</section>

<hr class="my-5 container">

<section id="profile-answers" class="container">
    <h3 class="mb-4">My Answers</h3>
    <?php for($i = 0; $i < 2; $i++){ ?> 
        <article class="profile-question container my-4 border shadow rounded">
            <!-- Question Title -->
            <div class="row">
                <div class="col-2">
                    <h4>20 Upvotes</h4>
                </div>

                <div class="d-flex align-items-center col">
                    <h2 class="card-title flex-grow-1"><a href="#">Should I learn MIPS?</a></h2> <!-- Question Title -->

                    <span class="category course badge rounded-pill bg-secondary">
                        <i class="fas fa-check"></i>
                    </span>
                </div>
            </div>
            
            <div class="row">
                <section class="col-2 mt-5">
                </section>

                <!-- Question Text -->
                <div class="question-content col">
                    <h4>Answer:</h4>
                    <p>Is the MIPS programming language that beneficial to know? I'm a CS student and am taking a assembly class which focuses on MIPS. I'm very comfortable writing in high level languages, but MIPS has me a little bit down. Is MIPS something that I should really focus on and try to completely grasp it? Will it help me in the future?</p>
                </div>
            </div>

            <!-- Question Date -->
            <section class="float-right">
                <img class="rounded-circle" src="images/profile.png" alt=""> <!-- Small Profile Image -->
                <div>
                    <span>Joaquina Almeida</span> <!-- Name -->
                    <span >15:02 - 10/05/2009</span> <!-- Date -->
                </div>
            </section>
        </article>
    <?php } ?>
</section>