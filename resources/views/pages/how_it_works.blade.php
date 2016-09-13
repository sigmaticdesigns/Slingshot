@extends('layouts.master')

@section('title', $page->title )

@section('content')
    <div class="static-page">
        <div class="static-page__banner static-page__banner--faq">
            <h1>We know you are excited to get started, but before you do, here are some things you should know about the SLINGSHOT market place.</h1>
        </div>
        <div class="static-page__blocks">
            <div class="static-page__block-item">
                <div class="static-page__block-title">Have an idea? SLINGSHOT is for you!</div>
                <div class="static-page__block-cont"><p>We welcome all projects: from green projects to film, theater, technology, art and craft, agriculture, you name it. We are currently only running non-profits, community organizations and groups</p></div>
            </div>

            <div class="static-page__block-item static-page__block-item--colored">
                <div class="static-page__block-title">Funders are just as enthusiastic as creators!</div>
                <div class="static-page__block-cont"><p>There is no greater feeling than supporting someone or a campaign that means something to you. Small tokens and rewards go a long way. So if you’re project is about creating cool and new craft from balata for example, maybe your backers can have a sample of your creation as reward or token of appreciation. It’s more about being a part of something that makes a difference or adds value than just financial returns.</p>
                    <p>Creators decide what rewards they will offer benefactors for their support. We recommend rewards vary depending level of support.</p></div>
            </div>

            <div class="static-page__block-item static-page__block-item--colored">
                <div class="static-page__block-title">Go all the way or go back to the drawing board…</div>
                <div class="static-page__block-cont"><p>In order to safeguard creators and innovators from being stuck “between a rock and a hard place”, i.e., with only half or a fraction of the funding they require for a project and project supporters expecting full results, we do all or nothing funding. Look at it this way, funders may be more likely to support your project if they know they will get their money back if the project is not fully funded.</p>
                    <p>A defined funding timeline and goal is necessary for every project, i.e., how much funding is needed. United State dollars will be the default currency for creators and funders.</p>
                </div>
            </div>

            <div class="static-page__block-item">
                <div class="static-page__block-title">The SLINGSHOT Team is here for you.</div>
                <div class="static-page__block-cont"><p>We know that there are many of you out there that have great ideas and interesting and innovative products that you want the world to see. However, you may be having trouble putting your thoughts into colorful words that express your enthusiasm and conviction. No problem! We will help you find the right words and get your ideas across to potential funders.</p></div>
            </div>
        </div>
        <div class="faq">
            <div class="faq__container">
                <div class="faq__item">
                    <div class="faq__title"><span>+</span>Do I have to pay? What is the catch?</div>
                    <div class="faq__answer"><p>As a project creator, there are no direct or upfront costs to bringing your project online. SLINGSHOT collects a 5% fee from successfully funded projects. We only succeed if you do.</p><p>Contributions on SLINGSHOT are collected and processed by a payment partner. Payment processing fees are around 3-5%.
                            Please note that as a creator you never give up any ownership or rights to your work.
                        </p></div>
                </div>

                <div class="faq__item">
                    <div class="faq__title"><span>+</span>What can I use SLINGSHOT to fund?</div>
                    <div class="faq__answer"><p>Anything! Ok, anything legal that is. In some Caribbean countries, where marihuana and its byproducts have been legalized, you can fund a project of that nature too.
                            Nevertheless, let’s establish a few boundaries here. Please see our <a href="/">rules</a>.
                        </p></div>
                </div>

                <div class="faq__item">
                    <div class="faq__title"><span>+</span>Am I eligible? Where is SLINGSHOT available?</div>
                    <div class="faq__answer"><p>If you are a Caribbean national, then you are set! The best part, anyone anywhere can be a funder! You must be at least 18 years of age to register on SLINGSHOT and create a project. If you are younger, then you must have adult supervision.
                        </p></div>
                </div>

                <div class="faq__item">
                    <div class="faq__title"><span>+</span>Do you screen projects?</div>
                    <div class="faq__answer"><p>The only screening we do is for adequacy in terms of appropriateness and to ensure projects meet our <a href="">rules</a>. Otherwise, the answer is no. Whether or not we think a project will succeed is not important. We won’t reject a project because a team member thinks sugar cane juice is too sweet.
                        </p></div>
                </div>

                <div class="faq__item">
                    <div class="faq__title"><span>+</span>Where does the support and money come from? </div>
                    <div class="faq__answer"><p>From everywhere! As long as the funder has a debit or credit card, they can support. The best place to start from of course is at home. Support from friends and family to get the ball rolling. They can help spread the word – good well-communicated ideas are contagious.
                        </p></div>
                </div>

                <div class="faq__item">
                    <div class="faq__title"><span>+</span>What happens if I get funded?</div>
                    <div class="faq__answer"><p>Congratulations! Let’s get started on your project.
                        </p><p>Now your funders’ cards will be charged and in 2-3 weeks funds will be transferred to your bank account from our payment processor. The ball is in your court now.</p><p>It is important that you share the progress of your work as you go along. Our team will assist you to keep on track and monitor progress. Even if there is no progress or changes in your work plan, it’s still important to make updates. It will be appreciated. Please see our <a href="">rules</a> on project implementation.</p><p>We will assist you, once rewards and products are ready, to get all the information you need from each funder, like mailing addresses, sizes or color preference. Package and mail rewards to your valuable and … funders. Presto!</p></div>
                </div>

                <div class="faq__item">
                    <div class="faq__title"><span>+</span>Not sure that I can run a project… How much work is it to run a project?</div>
                    <div class="faq__answer"><p>First of all, IT’S WORTH IT! There will be good moments and exhausting moments and frustrating moments. If being successful were easy then everyone would be.
                        </p><p>The amount of work would generally depend on how many moving parts there are or in other words, how complex and how big or small a project is. The first few days may be frustrating since getting people excited about a project may take some time… or it can happen of the bat! So it’s important to start campaigning a.s.a.p. and answer questions promptly as they arise.</p><p>Bringing a project to life is very rewarding and usually funders are as excited about a project as the creator is. So show enthusiasm and keep at it.</p></div>
                </div>

                <div class="faq__item">
                    <div class="faq__title"><span>+</span>What happens if I don’t get funded?</div>
                    <div class="faq__answer"><p>First, Don’t be too hard on yourself. Use it as a learning experience and used lessons learned from the first go around and have a go at it again. That’s right! Creators are welcome and encouraged to prelaunch their campaign on SLINGSHOT.
                        </p><p>Look at the positives. Creators will get useful feedback and meet people interested in their project that can help garner even more momentum for round two on SLINGSHOT.</p></div>
                </div>

                <div class="faq__item">
                    <div class="faq__title"><span>+</span>Should I make a video? Pictures?</div>
                    <div class="faq__answer"><p>We highly recommend you do. This adds soul and compassion to your project(s). Tell your story, sell your project and get funded.
                        </p><p>Our team can assist you to put together material for your project proposal (available only in Guyana for now). Remember, we only succeed if you do.</p></div>
                </div>

                <div class="faq__item">
                    <div class="faq__title"><span>+</span>How to make my project a SLINGSHOT Favourite?</div>
                    <div class="faq__answer"><p>It’s all about your story – videos and pictures as well - and how you follow up with funders. We keep an eye out for projects that do a brilliant job of using SLINGSHOT.
                        </p><p>Being a SLINGSHOT Favourite keeps…</p></div>
                </div>

                <div class="faq__item">
                    <div class="faq__title"><span>+</span>Why should I use SLINGSHOT and not another crowd funder?</div>
                    <div class="faq__answer"><p>SLINGSHOT is designed for developing economies. Unlike other crowd funding platforms that put the entire wait on your shoulders in terms of project development, we help you from the ground up – project proposal development, project designs (videos and pictures), getting the word out and even post funding business (project) support services. Let’s get you funded!</p></div>
                </div>

                <div class="faq__item">
                    <div class="faq__title"><span>+</span>I still have more questions. How do I get in touch?</div>
                    <div class="faq__answer"><p>The team is always here for you if you have questions. Click <a href="">here</a> to get answers.</p></div>
                </div>
            </div>
        </div>
        <div class="static-page__banner">
            <h1>Now that you have a better idea of how we work and what we do, lets get you started shall we!</h1>
        </div>

        <div class="how-to">
            <div class="how-to__title">Creating and having your project on SLINGSHOT is very simple</div>
            <div class="how-to__wrap">
                <ul class="how-to__list">
                    <li class="how-to__item" data-id="1">1. Create an account</li>
                    <li class="how-to__item" data-id="2">2. Build your project</li>
                    <li class="how-to__item" data-id="3">3. Launch it</li>
                    <li class="how-to__item" data-id="4">4. Track your progress and funding</li>
                    <li class="how-to__item" data-id="5">5. Funding goal achieved!</li>
                </ul>
                <div class="how-to__images">
                    <img src="/img/how-to_1.png" data-value="1" alt="Create an account" class="how-to__img how-to__img--5" width="350" height="250">
                    <img src="/img/how-to_2.png" data-value="2" alt="Build your project" class="how-to__img" width="221" height="540">
                    <img src="/img/how-to_3.png" data-value="3" alt="Launch it" class="how-to__img" width="221" height="540">
                    <img src="/img/how-to_4.png" data-value="4" alt="Track your progress and funding" class="how-to__img" width="800" height="250">
                    <img src="/img/how-to_5.png" data-value="5" alt="Funding goal achieved!" class="how-to__img" width="800" height="250">
                </div>
            </div>
        </div>
    </div>

    <section class="new-project">
        <div class="new-project__wrap">
            <h1 class="new-project__title">Ready To Promote Your New Project?</h1>
            <p class="new-project__content">The European languages are members of the same family. Their separate existence is a myth.</p>
            <a href="{!! route('projects.index') !!}" class="btn btn--explore">Explore a project</a>
            <a href="{!! route('user.projects.create') !!}" class="btn btn--create-new">Create a project</a>
        </div>
    </section>
@stop