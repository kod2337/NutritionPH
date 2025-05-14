<div id="chatbot-container">
    <button id="chatbot-toggle">🤖 Chat with NutriBot</button>
    <div id="chatbox" class="hidden">
        <div id="chat-header">
            <span>NutriBot</span>
            <button id="clear-chat">Clear Chat</button>
            <button id="close-chat">×</button>
        </div>
        <div id="chat-content"></div>

        <!-- Quick Reply Buttons -->
        <div id="chat-options">
            <button class="chat-option" data-message="What is NourishedPH?">What is NourishedPH?</button>
            <button class="chat-option" data-message="I want to order food" data-redirect="menu.php">Order Food</button>
            <button class="chat-option" data-message="I want to donate" data-redirect="donate.php">Donate</button>
            <button class="chat-option" data-message="I want to learn more about nutrition and food waste" data-redirect="modules.php">Learn More About Nutrition & Food Waste</button>
            <button class="chat-option" data-message="I want to leave feedback" data-redirect="feedback.php">Give Feedback</button>
        </div>

        <input type="text" id="chat-input" placeholder="Type a message..." />
        <button id="send-message">Send</button>
    </div>
</div>

<style>
/* Position the chatbot in the lower right corner */
#chatbot-container {
    position: fixed;
    bottom: 20px;
    right: 20px;
    z-index: 1000;
}

/* Chatbot toggle button with bounce effect */
@keyframes bounce {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-5px); }
}

#chatbot-toggle {
    background-color: var(--yellow);
    color: black;
    border: var(--border);
    padding: 10px 15px;
    cursor: pointer;
    border-radius: 50px;
    font-weight: bold;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    animation: bounce 1.5s infinite;
}

/* Chatbox container */
#chatbox {
    width: 320px;
    background: white;
    border: 1px solid black;
    border-radius: 10px;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
    position: absolute;
    bottom: 50px;
    right: 0;
    display: none;
    flex-direction: column;
}

/* Chat header */
#chat-header {
    background: #deb00bfa;
    padding: 12px;
    color: black;
    font-weight: bold;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-radius: 10px 10px 0 0;
    font-size: 15px;
}

#clear-chat {
    background: none;
    border: none;
    color: black;
    font-size: 12px;
    cursor: pointer;
    font-weight: bold;

}

#close-chat {
    background: none;
    border: none;
    color: black;
    font-size: 18px;
    cursor: pointer;
    font-weight: bold;
}

/* Chat messages */
#chat-content {
    height: 200px;
    overflow-y: auto;
    padding: 10px;
    border-bottom: 1px solid #ccc;
    font-size: 12px;
}

/* Quick Reply Buttons */
#chat-options {
    display: flex;
    flex-wrap: wrap;
    gap: 5px;
    padding: 10px;
    justify-content: center;
}

.chat-option {
    background: #deb00bfa;
    color: black;
    border: var(--border);
    padding: 5px 10px;
    cursor: pointer;
    border-radius: 5px;
    font-size: 12px;
}

.chat-option:hover {
    background: #deb00bfa;
}

/* Input field and send button */
#chat-input {
    width: 70%;
    padding: 10px;
    border: var(--border);
    margin-left: 5px;
    margin-bottom: 5px;
}

#send-message {
    width: 25%;
    padding: 10px;
    background: #deb00bfa;
    border: var(--border);
    color: black;
    cursor: pointer;
}
</style>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const chatbotToggle = document.getElementById("chatbot-toggle");
    const chatbotBox = document.getElementById("chatbox");
    const closeChat = document.getElementById("close-chat");
    const clearChat = document.getElementById("clear-chat");
    const sendMessage = document.getElementById("send-message");
    const chatInput = document.getElementById("chat-input");
    const chatContent = document.getElementById("chat-content");
    const chatOptions = document.querySelectorAll(".chat-option");

    // Load chat history from localStorage
    function loadChatHistory() {
        const history = localStorage.getItem("chatHistory");
        if (history) {
            chatContent.innerHTML = history;
            chatContent.scrollTop = chatContent.scrollHeight;
        }
    }

    // Save chat history to localStorage
    function saveChatHistory() {
        localStorage.setItem("chatHistory", chatContent.innerHTML);
    }

    // Open and close chatbot
    chatbotToggle.addEventListener("click", function () {
        chatbotBox.style.display = chatbotBox.style.display === "block" ? "none" : "block";
        if (chatbotBox.style.display === "block") {
            loadChatHistory();
        }
    });

    closeChat.addEventListener("click", function () {
        chatbotBox.style.display = "none";
    });

    // Handle user sending messages
    sendMessage.addEventListener("click", function () {
        sendMessageToChat(chatInput.value);
    });

    chatInput.addEventListener("keypress", function (event) {
        if (event.key === "Enter") {
            sendMessageToChat(chatInput.value);
        }
    });

    chatOptions.forEach(option => {
        option.addEventListener("click", function () {
            const message = option.getAttribute("data-message");
            const redirectURL = option.getAttribute("data-redirect");
            sendMessageToChat(message);
            if (redirectURL) {
                setTimeout(() => {
                    window.location.href = redirectURL;
                }, 1000);
            }
        });
    });

    function sendMessageToChat(userMessage) {
        if (!userMessage.trim()) return;

        chatContent.innerHTML += `<p><strong>You:</strong> ${userMessage}</p>`;
        chatInput.value = "";
        saveChatHistory();

        setTimeout(() => {
            let botMessage = generateBotResponse(userMessage);
            chatContent.innerHTML += `<p><strong>NutriBot:</strong> ${botMessage}</p>`;
            chatContent.scrollTop = chatContent.scrollHeight;
            saveChatHistory();
        }, 1000);
    }

    // NutriBot's response logic
    function generateBotResponse(message) {
    switch (message.toLowerCase()) {
        case "what is nourishedph?":
            return "NourishedPH is a web-based platform dedicated to reducing hunger and minimizing food waste in the Philippines. We connect individuals with affordable, nutritious meals while promoting sustainable food practices.";
        case "i want to order food":
            setTimeout(() => window.location.href = "menu.php", 3000);
            return "Redirecting you to our menu... 🍽️";
        case "i want to donate":
            setTimeout(() => window.location.href ="donate.php",3000);
            return "Thank you for your kindness! Redirecting to our donation page... ❤️";
        case "i want to learn more about nutrition and food waste":
            setTimeout(() => window.location.href ="modules.php",3000);
            return "Great choice! Redirecting to our learning modules... 📚";
        case "i want to leave a feedback":
        case "i want to give a feedback":
             setTimeout(() => window.location.href ="feedback.php", 3000);
            return "We value your feedback! Redirecting to our feedback form... 📝";
        case "hi":
        case "hello":
        case "hey":
            return "Hello there! How can I assist you today? 😊";
        case "how does it work?":
            return "NourishedPH partners with restaurants, food businesses, and donors to provide affordable meals to those in need. You can order, donate, or learn more through our platform.";
        case "what payment methods do you accept?":
            return "We accept Cash or GCash for secure transactions. 💳";
        case "do you deliver?":
            return "Not yet. We are currently working on it. Come by at our nearest Food Stall. We'll keep you updated for the location! 📍";
        case "can restaurants partner with nourishedph?":
            return "Absolutely! We welcome restaurants and food providers to join us in reducing food waste. Contact us to partner today!";
        case "i need customer support":
            setTimeout(() => window.location.href ="contact.php", 3000);
            return "Our support team is here to help! Redirecting to our contact page... 📞";
        case "thank you":
        case "thanks":
            return "You're very welcome! Let us know if there's anything else we can do for you. 😊";
        default:
            return "I'm not sure about that. Try selecting one of the options above!";
    }
}
clearChat.addEventListener("click", function () {
        chatContent.innerHTML = "";
        localStorage.removeItem("chatHistory");
    });

loadChatHistory();
});
</script>
