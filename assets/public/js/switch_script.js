const homePage = `
        <div class="d-flex align-items-center welcome-section">
            <div class="ms-5 px-5">
                <img class="profile-img" src="assets/public/img/morad.png"></img>
            </div>

            <div class="me-auto">
                <div>
                    <h3 class="text-white mb-0">Welcome, User!</h3>
                    <span class="badge bg-dark-subtle my-2">
                        <p class="text-black my-0">Pick up games near you</p>
                    </span>
                    <span class="badge bg-dark-subtle my-2">
                        <p class="text-black my-0">NEW Tournaments</p>
                    </span>
                </div>
            </div>

            <div class="d-flex flex-column m-auto">
                <button class="btn btn-dark m-2">Join Tournament</button>
                <button class="btn btn-outline-light m-2">Find Partners</button>
            </div>
        </div>


        <div class="d-flex mt-4">
            <div class="d-flex align-items-center mx-5 search-partners-section">
                <div class="d-flex align-items-center flex-column">
                    <h3 class="fs-2 fw-bold">Search for Partners</h3>
                    <p>Select player level, position, and type of request</p>
                </div>
            </div>

            <div class="d-flex flex-column align-items-start mx-5">
                <div class="my-3 me-5">
                    <h4>Player level</h4>
                    <span class="d-inline-flex gap-2">
                        <button type="button" class="btn" data-bs-toggle="button">Beginner</button>
                        <button type="button" class="btn" data-bs-toggle="button">Intermediate</button>
                        <button type="button" class="btn" data-bs-toggle="button">Advanced</button>
                    </span>
                </div>
                <div class="my-3">
                    <h4>Position</h4>
                    <div class="d-inline-flex gap-2">
                        <button type="button" class="btn" data-bs-toggle="button">Point Guard</button>
                        <button type="button" class="btn" data-bs-toggle="button">Winger</button>
                        <button type="button" class="btn" data-bs-toggle="button">Pivot</button>
                        <button type="button" class="btn" data-bs-toggle="button">Others</button>
                    </div>
                </div>
                <div class="d-flex justify-content-evenly mt-5 mx-auto">
                    <button class="btn btn-outline-dark me-5 px-xl py-2">Clear</button>
                    <button class="btn btn-dark ms-5 px-xl py-2">Search</button>
                </div>
            </div>
        </div>
        
        <div class="mt-4">
            <div class="d-flex flex-column align-items-center mx-5">
                <h3 class="fs-2 fw-bold">Recommended Partners</h3>
                <div class="d-flex justify-content-evenly mx-auto">
                    <button class="btn btn-outline-dark me-5 px-4 py-2">View Profile</button>
                    <button class="btn btn-dark ms-5 px-5 py-2">Invite</button>
                </div>
            </div>
            <div class="d-flex gap-4 recommended-profiles">
                <div class="text-center">
                    <img src="basketball.png" alt="John">
                    <p>John<br><small>Point Guard</small></p>
                </div>
                <div class="text-center">
                    <img src="basketball.png" alt="Sarah">
                    <p>Sarah<br><small>Winger</small></p>
                </div>
                <div class="text-center">
                    <img src="basketball.png" alt="Mike">
                    <p>Mike<br><small>Pivot</small></p>
                </div>
            </div>
        </div>
    </div>
        `;

const findPartnersPage = "<h2>Find Partners</h2><p>Find your next teammate here !</p>";

const profilePage = "<h2>Profile</h2><p>Make yourself look good</p>";

const settingsPage = "<h2>Settings</h2><p>Set things up.</p>";

function loadContent(page) {
    let content = document.getElementById("content");
    if (page === 'home') {
        content.innerHTML = homePage;
    } else if (page === 'partners') {
        content.innerHTML = findPartnersPage;
    } else if (page === 'profile') {
        content.innerHTML = profilePage;
    } else if (page === 'settings') {
        content.innerHTML = settingsPage;
    }
}

document.addEventListener("DOMContentLoaded", function() {
    sidebarTabs = document.querySelectorAll("#sidebar-list li a");
    
    sidebarTabs.forEach((tab) => {
        if (tab.classList.contains("active")) {
            const page = tab.getAttribute("data-page");
            loadContent(page);
        }
    });
});
