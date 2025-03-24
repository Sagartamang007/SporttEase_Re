<style>
    /* SportEase Admin Logout Button Styles */
form[action*="logout"] button {
    background-color: transparent;
    color: #e74c3c;
    border: 1px solid #e74c3c;
    border-radius: 4px;
    padding: 10px 16px;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
    outline: none;
    width: auto;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* Hover effect */
form[action*="logout"] button:hover {
    background-color: #e74c3c;
    color: white;
    box-shadow: 0 4px 8px rgba(231, 76, 60, 0.3);
    transform: translateY(-2px);
}

/* Active/pressed state */
form[action*="logout"] button:active {
    transform: translateY(0);
    box-shadow: 0 2px 4px rgba(231, 76, 60, 0.3);
}

/* Add icon with pseudo-element */
form[action*="logout"] button:before {
    content: "🚪";
    margin-right: 8px;
    font-size: 16px;
    transition: transform 0.3s ease;
}

form[action*="logout"] button:hover:before {
    transform: translateX(-2px);
}

/* For when the button is in the sidebar */
.sidebar form[action*="logout"] button {
    background-color: transparent;
    color: #e74c3c;
    border: none;
    width: 100%;
    text-align: left;
    padding: 12px 20px;
    font-size: 16px;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 0;
    margin-top: 20px;
    justify-content: flex-start;
}

.sidebar form[action*="logout"] button:hover {
    background-color: rgba(231, 76, 60, 0.2);
    box-shadow: none;
    transform: none;
    padding-left: 24px;
}

/* Responsive styles */
@media (max-width: 768px) {
    .sidebar form[action*="logout"] button {
        padding: 15px 0;
        text-align: center;
        justify-content: center;
    }

    .sidebar form[action*="logout"] button:before {
        margin-right: 0;
    }

    .sidebar form[action*="logout"] button span {
        display: none;
    }

    /* For standalone button on mobile */
    form[action*="logout"] button:not(.sidebar *) {
        padding: 8px 12px;
        font-size: 13px;
    }
}

/* If you want to use it as a full-width button outside the sidebar */
.logout-container form[action*="logout"] button {
    width: 100%;
    padding: 12px;
    margin-top: 15px;
    font-weight: 600;
}

/* If you want to use it as a navbar button */
.navbar form[action*="logout"] button {
    background-color: transparent;
    border: 1px solid #e74c3c;
    padding: 6px 12px;
    font-size: 13px;
}

.navbar form[action*="logout"] button:hover {
    background-color: #e74c3c;
}
    </style>

<div style="display: flex; justify-content: space-between; align-items: center;">
    <form action="{{ route('admin.logout') }}" method="POST" style="display: inline;">
        @csrf
        <button type="submit">Logout</button>
    </form>
</div>
