<div class="live-chatbox-container mb-4 pb-3" id="message_management" data-section="message_management">
    <div class="live-chat-title border-bottom mb-2">
        <div class="live-chat-title fs-4 fw-bold text-uppercase">Live Chat</div>
        <div class="hero-right-title-container d-flex flex-wrap flex-row align-items-end justify-content-between">
            <div class="date-time d-flex flex-wrap">
                <span id="hours">00</span>
                <span>:</span>
                <span id="minutes">00</span>
                <span id="session">AM</span>
                <span>—</span>
                <span id="day">Day</span>
                <span class="me-1">,</spanc>
                <span id="date">00</span>
                <span id="month">Month</span>
                <span id="year">Year</span>
            </div>
        </div>
    </div>
    <div class="live-chatbox rounded bg-white p-3" id="chatbox">
        <div id="messages"></div>
        <div class="chat-form">
            <select class="form-select mb-1" name="barangay" id="barangay" aria-label="Select Barangay" required>
                <option Selected>Select Brgy.</option>
                <option value="Acacia">Acacia</option>
                <option value="Baritan">Baritan</option>
                <option value="Bayan-Bayanan">Bayan-Bayanan</option>
                <option value="Catmon">Catmon</option>
                <option value="Concepcion">Concepcion</option>
                <option value="Dampalit">Dampalit</option>
                <option value="Flores">Flores</option>
                <option value="Hulong Duhat">Hulong Duhat</option>
                <option value="Ibaba">Ibaba</option>
                <option value="Longos">Longos</option>
                <option value="Maysilo">Maysilo</option>
                <option value="Muzon">Muzon</option>
                <option value="Niugan">Niugan</option>
                <option value="Panghulo">Panghulo</option>
                <option value="Potrero">Potrero</option>
                <option value="San Agustin">San Agustin</option>
                <option value="Santolan">Santolan</option>
                <option value="Tañong">Tañong</option>
                <option value="Tinajeros">Tinajeros</option>
                <option value="Tonsuya">Tonsuya</option>
                <option value="Tugatog">Tugatog</option>
            </select>
            <div class="form-floating mb-2">    
                <input type="text" id="user_name" name="user_name" class="form-control" placeholder="Leave a comment here" id="floatingTextarea"required>
                <label for="floatingTextarea">Enter your name</label>
            </div>
            <div class="form-floating mb-2">    
                <textarea id="message" class="form-control" placeholder="Leave a comment here" id="floatingTextarea"required></textarea>
                <label for="floatingTextarea">Enter your concerns here...</label>
            </div>
            <div class="chatbox-btn mb-2">
                <button class="btn btn-dark" type="submit" id="send">Send</button>
            </div>
        </div>
    </div>
</div>