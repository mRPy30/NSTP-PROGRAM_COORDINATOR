<!DOCTYPE html>
<html>
<head>
  <title>Calendar</title>
  <style>
    body {
      font-family: Arial, sans-serif;
    }
    .container{
      width: 1000px;
      height: 600PX;
      border: 1px solid black;
      display: flex;
      flex-direction: column;
      padding:10px;
    }

    .calendar {
      max-width: 400px;
    
      padding: 20px;
      background-color: #f2f2f2;
      border-radius: 5px;
      border: 1px solid black;
    }

    .calendar-title {
      text-align: center;
      font-size: 24px;
      margin-bottom: 20px;
    }

    .month-navigation {
      display: flex;
      justify-content: space-between;
      margin-bottom: 10px;
    }

    .month-navigation button {
      background-color: #4CAF50;
      color: #ffffff;
      border: none;
      padding: 5px 10px;
      border-radius: 3px;
      cursor: pointer;
    }

    .calendar-grid {
      display: grid;
      grid-template-columns: repeat(7, 1fr);
      grid-gap: 10px;
      margin: 10px;
    }

    .calendar-day {
      text-align: center;
      padding: 5px;
      cursor: pointer;
      transition: background-color 0.3s ease;
      border: 1px solid black;
      height: 30px;
      width: 30px;
    }

    .calendar-day:hover {
      background-color: #4CAF50;
      color: #ffffff;
    }

    .event-indicator {
      position: relative;
    }

    .event-indicator::after {
      content: "";
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 6px;
      height: 6px;
      background-color: #4CAF50;
      border-radius: 50%;
      display: none;
    }

    .event-panel {
    
      padding: 10px;
      background-color: #ffffff;
      border: 1px solid #ccc;
      border-radius: 5px;
      width: 300px;
     
   
    }

    .event-panel-title {
      font-size: 18px;
      margin-bottom: 10px;
    }

    .event-panel-content {
      font-size: 14px;
    }

    .create-event-btn {
      background-color: #4CAF50;
      color: #ffffff;
      border: none;
      padding: 10px 15px;
      border-radius: 3px;
      cursor: pointer;
      margin-bottom: 20px;
    }

    .create-event-btn:hover {
      background-color: #45a049;
    }

  </style>
</head>
<body>
  <div class="container">
    <div class="calendar">
        <div class="calendar-title">June 2023</div>
        
        <div class="month-navigation">
          <button id="prevMonthBtn">Previous</button>
          <button id="nextMonthBtn">Next</button>
        </div>
        
        <div class="calendar-grid">
          <!-- Calendar days -->
        </div>

      <button id="createEventBtn" class="create-event-btn">Create Event</button>
    </div>

    <div class="event-panel">
        <div class="event-panel-title">Event Title</div>
        <div class="event-panel-content">Event Description</div>
    </div>

  </div>






















  <script>
    // JavaScript code

    // Get current date
    const currentDate = new Date();

    // Get calendar elements
    const calendarTitle = document.querySelector('.calendar-title');
    const calendarGrid = document.querySelector('.calendar-grid');
    const eventPanel = document.querySelector('.event-panel');
    const eventPanelTitle = eventPanel.querySelector('.event-panel-title');
    const eventPanelContent = eventPanel.querySelector('.event-panel-content');

    // Set initial calendar state
    let currentMonth = currentDate.getMonth();
    let currentYear = currentDate.getFullYear();

    // Function to update the calendar
    function updateCalendar() {
      // Clear previous calendar days
      calendarGrid.innerHTML = '';

      // Update calendar title
      calendarTitle.textContent = `${getMonthName(currentMonth)} ${currentYear}`;

      // Get the first day of the month
      const firstDay = new Date(currentYear, currentMonth, 1);

      // Get the number of days in the month
      const lastDay = new Date(currentYear, currentMonth + 1, 0).getDate();

      // Create calendar days
      for (let i = 1; i <= lastDay; i++) {
        const calendarDay = document.createElement('div');
        calendarDay.classList.add('calendar-day');
        calendarDay.textContent = i;

        // Check if there are events on this day (you can customize this logic)
        const hasEvents = i === 4 || i === 8; // Example: events on the 4th and 8th days

        if (hasEvents) {
          calendarDay.classList.add('event-indicator');
        }

        calendarDay.addEventListener('click', () => {
          // Display event details in the panel (you can customize this logic)
          eventPanelTitle.textContent = `Event on ${getMonthName(currentMonth)} ${i}, ${currentYear}`;
          eventPanelContent.textContent = 'Event details go here...';
        });

        calendarGrid.appendChild(calendarDay);
      }
    }

    // Function to get the name of a month based on its index
    function getMonthName(monthIndex) {
      const monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
      return monthNames[monthIndex];
    }

    // Function to navigate to the previous month
    function prevMonth() {
      if (currentMonth === 0) {
        currentMonth = 11;
        currentYear--;
      } else {
        currentMonth--;
      }
      updateCalendar();
    }

    // Function to navigate to the next month
    function nextMonth() {
      if (currentMonth === 11) {
        currentMonth = 0;
        currentYear++;
      } else {
        currentMonth++;
      }
      updateCalendar();
    }

    // Function to create a new event
    function createEvent() {
      const eventTitle = prompt('Enter the event title:');
      if (eventTitle) {
        const eventDescription = prompt('Enter the event description:');
        if (eventDescription) {
          // Handle the creation of the event (you can customize this logic)
          console.log('Event created:');
          console.log('Title:', eventTitle);
          console.log('Description:', eventDescription);
        }
      }
    }

    // Add event listeners to the navigation buttons and create event button
    document.getElementById('prevMonthBtn').addEventListener('click', prevMonth);
    document.getElementById('nextMonthBtn').addEventListener('click', nextMonth);
    document.getElementById('createEventBtn').addEventListener('click', createEvent);

    // Initial calendar update
    updateCalendar();
  </script>
</body>
</html>
