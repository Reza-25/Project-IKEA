<?php
// Side Panel PHP File
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
  /* CSS untuk Sidebar Toggle Button */
  #toggle-btn {
    position: fixed;
    top: 70px;
    right: 15px;
    cursor: pointer;
    font-size: 12px; /* Smaller font size */
    background: rgba(0, 123, 255, 0.3); /* More transparent (30%) */
    color: white;
    border-radius: 50%; /* Makes it circular */
    width: 35px; /* Smaller width */
    height: 35px; /* Smaller height */
    display: flex;
    align-items: center;
    justify-content: center;
    user-select: none;
    transition: all 0.3s ease;
    box-shadow: 0 1px 4px rgba(0, 123, 255, 0.2); /* Softer shadow */
    z-index: 1001;
    border: 1px solid rgba(0, 123, 255, 0.2); /* Thinner border */
    backdrop-filter: blur(3px); /* Less blur effect */
  }

  #toggle-btn:hover {
    background-color: rgba(0, 123, 255, 0.6); /* Less transparent on hover */
    border-color: rgba(0, 123, 255, 0.4);
    transform: scale(1.05); /* Smaller scale on hover */
    box-shadow: 0 2px 8px rgba(0, 123, 255, 0.3);
  }

  /* Tooltip for toggle button */
  #toggle-btn::after {
    content: "Widget Panel";
    position: absolute;
    left: -100px;
    top: 50%;
    transform: translateY(-50%);
    background: white;
    color: #0066cc;
    padding: 8px 12px;
    border-radius: 6px;
    font-size: 12px;
    white-space: nowrap;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
    z-index: 10000;
    pointer-events: none;
    box-shadow: 0 2px 8px rgba(0,0,0,0.15);
    border: 1px solid #e9ecef;
  }

  #toggle-btn::before {
    content: '';
    position: absolute;
    left: -12px;
    top: 50%;
    transform: translateY(-50%);
    width: 0;
    height: 0;
    border-left: 8px solid white;
    border-top: 8px solid transparent;
    border-bottom: 8px solid transparent;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
    z-index: 10000;
    pointer-events: none;
  }

  #toggle-btn:hover::after,
  #toggle-btn:hover::before {
    opacity: 1;
    visibility: visible;
  }

  /* CSS untuk Sidebar Kanan - Dropdown Panel */
  #side-panel {
    position: fixed;
    top: 120px; /* Positioned below toggle button */
    right: 15px;
    width: 60px;
    max-height: 0;
    background-color: #f8f9fa;
    border: 1px solid #dee2e6;
    display: flex;
    flex-direction: column;
    align-items: center;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    transition: all 0.3s ease;
    z-index: 1000;
    border-radius: 12px;
    overflow: hidden;
    opacity: 0;
    transform: translateY(-10px);
  }

  #side-panel.show {
    max-height: 500px;
    opacity: 1;
    transform: translateY(0);
  }

  /* Wrapper ikon */
  #icons-wrapper {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 15px;
    padding: 15px 0;
    flex-grow: 1;
    width: 100%;
  }

  .icon {
    cursor: pointer;
    font-size: 18px;
    width: 36px;
    height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    background-color: #ffffff;
    color: #0066cc;
    transition: all 0.2s ease;
    border: 1px solid #e9ecef;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    position: relative;
    overflow: visible;
  }

  .icon:hover {
    transform: translateY(-2px);
    background-color: #0066cc;
    color: white;
    box-shadow: 0 4px 8px rgba(0,102,204,0.2);
    z-index: 1001;
  }

  /* Tooltip styling - Removed all tooltips */
  .icon::after {
    display: none;
  }

  .icon::before {
    display: none;
  }

  .icon:hover::after,
  .icon:hover::before {
    display: none;
  }

  /* Ensure tooltips appear above other elements */
  .icon::after {
    display: none;
  }

  @keyframes tooltipFadeIn {
    /* Animation removed since tooltips are disabled */
  }

  .plus-icon {
    margin-top: 5px;
    font-size: 14px;
    background-color: #0066cc;
    color: white;
  }

  .plus-icon:hover {
    background-color: #0052a3;
  }

  /* Remove unused collapsed styles */
  #side-panel.collapsed {
    max-height: 0;
    opacity: 0;
    transform: translateY(-10px);
  }

  /* Arrow animation for toggle button */
  #toggle-btn .arrow {
    transition: transform 0.3s ease;
    font-size: 14px;
    font-weight: bold;
  }

  #toggle-btn.active .arrow {
    transform: rotate(180deg);
  }

  /* Smooth dropdown animation */
  #side-panel {
    transform-origin: top center;
  }

  #side-panel.show {
    animation: dropdownOpen 0.3s ease-out;
  }

  @keyframes dropdownOpen {
    0% {
      max-height: 0;
      opacity: 0;
      transform: translateY(-10px) scaleY(0.8);
    }
    100% {
      max-height: 500px;
      opacity: 1;
      transform: translateY(0) scaleY(1);
    }
  }

  /* Close animation */
  #side-panel:not(.show) {
    animation: dropdownClose 0.3s ease-in;
  }

  @keyframes dropdownClose {
    0% {
      max-height: 500px;
      opacity: 1;
      transform: translateY(0) scaleY(1);
    }
    100% {
      max-height: 0;
      opacity: 0;
      transform: translateY(-10px) scaleY(0.8);
    }
  }

  #popup-container {
    position: fixed;
    background: white;
    border: 1px solid #dee2e6;
    box-shadow: 0 6px 16px rgba(0,0,0,0.12);
    padding: 20px;
    border-radius: 8px;
    z-index: 2000;
    min-width: 200px;
    max-width: 400px;
    max-height: 65vh; /* Reduced from 80vh to 50vh */
    overflow-y: auto;
  }

  #popup-container.hidden {
    display: none;
  }

  .popup-content {
    position: relative;
  }

  /* Updated close button styling */
  .popup-close-btn {
    position: absolute;
    top: -10px;
    right: -10px;
    background: linear-gradient(135deg, #dc3545, #c82333);
    color: white;
    border: none;
    border-radius: 6px; /* Changed from 50% to 6px for rounded square */
    width: 28px;
    height: 28px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    font-size: 12px;
    transition: all 0.2s ease;
    box-shadow: 0 2px 6px rgba(220, 53, 69, 0.3);
    z-index: 1000;
  }

  .popup-close-btn:hover {
    background: linear-gradient(135deg, #c82333, #bd2130);
    transform: scale(1.1);
    box-shadow: 0 4px 12px rgba(220, 53, 69, 0.4);
  }

  .popup-close-btn:active {
    transform: scale(0.95);
  }
</style>

<!-- Tombol Toggle dengan Arrow -->
<div id="toggle-btn" onclick="togglePanel()">
  <span class="arrow">▼</span>
</div>

<div id="side-panel">
  <!-- Wrapper ikon yang akan muncul dengan animasi dropdown -->
  <div id="icons-wrapper">
    <div class="icon" onclick="showPopup('calendar')"><i class="fas fa-calendar"></i></div>
    <div class="icon" onclick="showPopup('note')"><i class="fas fa-sticky-note"></i></div>
    <div class="icon" onclick="showPopup('task')"><i class="fas fa-check-circle"></i></div>
    <div class="icon" onclick="showPopup('chat')"><i class="fas fa-comments"></i></div>
    <div class="icon" onclick="showPopup('gmail')"><i class="fas fa-envelope"></i></div>
    <div class="icon plus-icon" onclick="showPopup('addon')"><i class="fas fa-plus"></i></div>
  </div>
</div>

<div id="popup-container" class="hidden">
  <div class="popup-content">
    <button class="popup-close-btn" onclick="closePopup()">
      <i class="fas fa-times"></i>
    </button>
    <div id="popup-title"></div>
  </div>
</div>

<script>
  // Set default date to July 22, 2024
  let currentDate = new Date(2024, 6, 22); // Month is 0-indexed, so 6 = July
  let currentMonth = 6; // July
  let currentYear = 2024;
  
  // Expanded events with categories and colors - Added more activities for July 22, 2024
  let events = {
    // July 2024 events
    '2024-07-22': [
      {title: 'Morning Jogging', category: 'health', time: '06:00-07:00'},
      {title: 'Team Standup Meeting', category: 'work', time: '09:00-09:30'},
      {title: 'Project Review with Client', category: 'work', time: '10:00-11:30'},
      {title: 'Lunch with Marketing Team', category: 'social', time: '12:00-13:00'},
      {title: 'Code Review Session', category: 'work', time: '14:00-15:30'},
      {title: 'Grocery Shopping', category: 'personal', time: '16:00-17:00'},
      {title: 'Movie Night with Friends', category: 'entertainment', time: '19:00-22:00'}
    ],
    '2024-07-21': [{title: 'Weekend Preparation', category: 'personal', time: '10:00-12:00'}],
    '2024-07-23': [{title: 'Yoga Class', category: 'health', time: '07:00-08:00'}, {title: 'Client Meeting', category: 'work', time: '14:00-15:00'}],
    '2024-07-24': [{title: 'Team Building Event', category: 'work', time: '09:00-17:00'}],
    '2024-07-25': [{title: 'Birthday Party', category: 'social', time: '18:00-23:00'}],
    '2024-07-26': [{title: 'Swimming', category: 'health', time: '08:00-09:30'}],
    '2024-07-27': [{title: 'Family BBQ', category: 'personal', time: '15:00-20:00'}],
    '2024-07-28': [{title: 'Monthly Planning', category: 'work', time: '09:00-11:00'}],
    '2024-07-29': [{title: 'Doctor Appointment', category: 'health', time: '10:00-11:00'}],
    '2024-07-30': [{title: 'Conference Call', category: 'work', time: '13:00-14:00'}],
    '2024-07-31': [{title: 'End of Month Review', category: 'work', time: '15:00-17:00'}],
    
    // Keep existing December events
    '2024-12-01': [{title: 'Monthly Planning', category: 'work', time: '09:00-10:00'}, {title: 'Grocery Shopping', category: 'personal', time: '15:00-16:00'}],
    '2024-12-03': [{title: 'Doctor Appointment', category: 'health', time: '14:00-15:00'}],
    '2024-12-05': [{title: 'Team Meeting', category: 'work', time: '10:00-11:30'}, {title: 'Project Planning', category: 'work', time: '14:00-16:00'}],
    '2024-12-07': [{title: 'Weekend Gym', category: 'health', time: '08:00-09:30'}],
    '2024-12-08': [{title: 'Family Dinner', category: 'personal', time: '18:00-20:00'}],
    '2024-12-10': [{title: 'Client Call', category: 'work', time: '11:00-12:00'}, {title: 'Lunch with Sarah', category: 'social', time: '12:30-14:00'}],
    '2024-12-12': [{title: 'Client Presentation', category: 'work', time: '15:00-16:30'}],
    '2024-12-14': [{title: 'Movie Night', category: 'entertainment', time: '19:00-22:00'}],
    '2024-12-15': [{title: 'Weekend Workout', category: 'health', time: '07:00-08:30'}],
    '2024-12-17': [{title: 'Team Building', category: 'work', time: '13:00-17:00'}],
    '2024-12-18': [{title: 'Code Review', category: 'work', time: '09:00-10:00'}, {title: 'Team Standup', category: 'work', time: '10:30-11:00'}],
    '2024-12-20': [{title: 'Christmas Shopping', category: 'personal', time: '10:00-15:00'}],
    '2024-12-22': [{title: 'Christmas Party', category: 'social', time: '18:00-23:00'}],
    '2024-12-24': [{title: 'Christmas Eve Dinner', category: 'personal', time: '17:00-21:00'}],
    '2024-12-25': [{title: 'Christmas Day', category: 'holiday', time: 'All Day'}],
    '2024-12-26': [{title: 'Boxing Day Rest', category: 'personal', time: 'All Day'}],
    '2024-12-28': [{title: 'Year End Review', category: 'work', time: '09:00-12:00'}],
    '2024-12-31': [{title: 'New Year Eve Party', category: 'social', time: '20:00-02:00'}],
    
    // January 2025
    '2025-01-01': [{title: 'New Year Day', category: 'holiday', time: 'All Day'}],
    '2025-01-02': [{title: 'Back to Work', category: 'work', time: '09:00-17:00'}],
    '2025-01-05': [{title: 'Weekly Planning', category: 'work', time: '08:00-09:00'}],
    '2025-01-10': [{title: 'Gym Session', category: 'health', time: '18:00-19:30'}],
    '2025-01-15': [{title: 'Project Deadline', category: 'work', time: '09:00-18:00'}],
    '2025-01-20': [{title: 'Birthday Party', category: 'social', time: '19:00-23:00'}]
  };

  // Category colors and icons
  const categoryStyles = {
    work: { color: '#0066cc', bg: '#e3f2fd', icon: 'fas fa-briefcase' },
    personal: { color: '#4caf50', bg: '#e8f5e8', icon: 'fas fa-user' },
    health: { color: '#ff5722', bg: '#ffebee', icon: 'fas fa-heartbeat' },
    social: { color: '#9c27b0', bg: '#f3e5f5', icon: 'fas fa-users' },
    entertainment: { color: '#ff9800', bg: '#fff3e0', icon: 'fas fa-film' },
    holiday: { color: '#f44336', bg: '#ffebee', icon: 'fas fa-star' }
  };

  function generateCalendarDays() {
    const firstDay = new Date(currentYear, currentMonth, 1);
    const lastDay = new Date(currentYear, currentMonth + 1, 0);
    const startDate = firstDay.getDay();
    const totalDays = lastDay.getDate();
    const targetDate = new Date(2024, 6, 22); // July 22, 2024
    
    let days = '';
    
    // Empty cells for days before month starts
    for (let i = 0; i < startDate; i++) {
      days += '<div style="padding: 8px;"></div>';
    }
    
    // Days of the month
    for (let day = 1; day <= totalDays; day++) {
      const dateStr = `${currentYear}-${String(currentMonth + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
      const isTargetDate = day === 22 && currentMonth === 6 && currentYear === 2024; // July 22, 2024
      const dayEvents = events[dateStr] || [];
      const hasEvent = dayEvents.length > 0;
      
      let style = 'text-align: center; padding: 6px 4px; font-size: 12px; cursor: pointer; border-radius: 4px; position: relative; min-height: 32px; display: flex; flex-direction: column; justify-content: center; align-items: center;';
      
      if (isTargetDate) {
        style += ' background: #0066cc; color: white; font-weight: bold; box-shadow: 0 2px 4px rgba(0,102,204,0.3); border: 2px solid #004499;';
      } else if (hasEvent) {
        // Multiple events - use gradient or dominant category color
        const dominantCategory = getDominantCategory(dayEvents);
        const categoryStyle = categoryStyles[dominantCategory];
        style += ` background: ${categoryStyle.bg}; color: ${categoryStyle.color}; border: 1px solid ${categoryStyle.color}40;`;
      } else {
        style += ' color: #333; hover:background: #f5f5f5;';
      }
      
      let eventIndicators = '';
      if (hasEvent) {
        // Show up to 3 event indicators
        const indicatorsToShow = dayEvents.slice(0, 3);
        indicatorsToShow.forEach((event, index) => {
          const categoryStyle = categoryStyles[event.category];
          eventIndicators += `<div style="position: absolute; bottom: 2px; left: ${4 + (index * 6)}px; width: 4px; height: 4px; background: ${categoryStyle.color}; border-radius: 50%; opacity: 0.8;"></div>`;
        });
        
        // Show +more indicator if there are more than 3 events
        if (dayEvents.length > 3) {
          eventIndicators += `<div style="position: absolute; bottom: 2px; right: 2px; font-size: 8px; color: #666;">+${dayEvents.length - 3}</div>`;
        }
      }
      
      days += `<div style="${style}" onclick="selectDate(${day})" title="${getEventTooltip(dayEvents)}">${day}${eventIndicators}</div>`;
    }
    
    return days;
  }

  function getTodayActivities() {
    // Always show activities for July 22, 2024
    const todayStr = '2024-07-22';
    const todayEvents = events[todayStr] || [];
    
    if (todayEvents.length === 0) {
      return '<p style="color: #666; font-size: 12px; text-align: center; padding: 20px;">No activities for today</p>';
    }
    
    let activities = '';
    todayEvents.forEach((event, index) => {
      const categoryStyle = categoryStyles[event.category];
      
      activities += `
        <div style="display: flex; align-items: center; margin-bottom: 8px; padding: 8px; background: ${categoryStyle.bg}; border-radius: 6px; border-left: 3px solid ${categoryStyle.color}; transition: transform 0.2s ease;">
          <div style="color: ${categoryStyle.color}; margin-right: 10px; font-size: 14px;">
            <i class="${categoryStyle.icon}"></i>
          </div>
          <div style="flex: 1;">
            <div style="font-size: 12px; font-weight: bold; color: ${categoryStyle.color};">${event.title}</div>
            <div style="font-size: 10px; color: #666;">${event.time}</div>
            <div style="font-size: 9px; color: #888; text-transform: capitalize;">${event.category}</div>
          </div>
        </div>
      `;
    });
    
    return `
      <div style="margin-bottom: 10px; padding: 8px; background: linear-gradient(135deg, #0066cc, #004499); color: white; border-radius: 6px; text-align: center;">
        <div style="font-size: 14px; font-weight: bold;">📅 July 22, 2024</div>
        <div style="font-size: 11px; opacity: 0.9;">Today's Schedule (${todayEvents.length} activities)</div>
      </div>
      ${activities}
    `;
  }

  // Update the calendar case in showPopup function
  function showPopup(type) {
    const popup = document.getElementById('popup-container');
    const title = document.getElementById('popup-title');
    const panel = document.getElementById('side-panel');

    const panelRect = panel.getBoundingClientRect();
    popup.style.top = `${panelRect.top + 50}px`;
    popup.style.left = `${panelRect.left - 350}px`;

    let content = '';
    
    switch(type) {
      case 'calendar':
        content = `
          <div style="width: 320px;">
            <h4 style="margin: 0 0 15px 0; color: #0066cc; font-size: 16px; text-align: center;">
              <i class="fas fa-calendar-alt"></i> Calendar
            </h4>
            
            <!-- Calendar Header -->
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
              <button onclick="changeMonth(-1)" style="background: none; border: none; font-size: 18px; cursor: pointer; color: #0066cc;">‹</button>
              <div style="display: flex; gap: 10px;">
                <select id="monthSelect" onchange="changeMonthYear()" style="padding: 4px; border: 1px solid #ddd; border-radius: 4px; font-size: 12px;">
                  <option value="0">January</option>
                  <option value="1">February</option>
                  <option value="2">March</option>
                  <option value="3">April</option>
                  <option value="4">May</option>
                  <option value="5">June</option>
                  <option value="6">July</option>
                  <option value="7">August</option>
                  <option value="8">September</option>
                  <option value="9">October</option>
                  <option value="10">November</option>
                  <option value="11">December</option>
                </select>
                <select id="yearSelect" onchange="changeMonthYear()" style="padding: 4px; border: 1px solid #ddd; border-radius: 4px; font-size: 12px;">
                  ${generateYearOptions()}
                </select>
              </div>
              <button onclick="changeMonth(1)" style="background: none; border: none; font-size: 18px; cursor: pointer; color: #0066cc;">›</button>
            </div>
            
            <!-- Calendar Grid -->
            <div id="calendarGrid" style="display: grid; grid-template-columns: repeat(7, 1fr); gap: 2px; margin-bottom: 15px;">
              <div style="text-align: center; font-weight: bold; color: #666; padding: 8px; font-size: 12px;">Sun</div>
              <div style="text-align: center; font-weight: bold; color: #666; padding: 8px; font-size: 12px;">Mon</div>
              <div style="text-align: center; font-weight: bold; color: #666; padding: 8px; font-size: 12px;">Tue</div>
              <div style="text-align: center; font-weight: bold; color: #666; padding: 8px; font-size: 12px;">Wed</div>
              <div style="text-align: center; font-weight: bold; color: #666; padding: 8px; font-size: 12px;">Thu</div>
              <div style="text-align: center; font-weight: bold; color: #666; padding: 8px; font-size: 12px;">Fri</div>
              <div style="text-align: center; font-weight: bold; color: #666; padding: 8px; font-size: 12px;">Sat</div>
              
              ${generateCalendarDays()}
            </div>
            
            <!-- Today's Activities -->
            <div style="border-top: 1px solid #eee; padding-top: 15px;">
              <h5 style="margin: 0 0 10px 0; color: #0066cc; font-size: 14px;">
                <i class="fas fa-clock"></i> Today's Activities
              </h5>
              <div id="todayActivities" style="max-height: 200px; overflow-y: auto;">
                ${getTodayActivities()}
              </div>
            </div>
            
            <!-- Quick Actions -->
            <div style="display: flex; gap: 8px; margin-top: 15px;">
              <button onclick="addEvent()" style="flex: 1; padding: 8px; background: #0066cc; color: white; border: none; border-radius: 4px; font-size: 12px; cursor: pointer;">
                <i class="fas fa-plus"></i> Add Event
              </button>
              <button onclick="viewAll()" style="flex: 1; padding: 8px; background: #6c757d; color: white; border: none; border-radius: 4px; font-size: 12px; cursor: pointer;">
                <i class="fas fa-eye"></i> View All
              </button>
            </div>
          </div>
        `;
        break;
        
      case 'addEvent':
        content = `
          <div style="width: 300px;">
            <h4 style="margin: 0 0 15px 0; color: #0066cc; font-size: 16px; text-align: center;">
              <i class="fas fa-plus"></i> Add New Event
            </h4>
            
            <div style="margin-bottom: 15px;">
              <label style="display: block; margin-bottom: 5px; font-weight: bold; font-size: 12px;">Event Title:</label>
              <input type="text" id="eventTitle" placeholder="Enter event title" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; font-size: 12px;">
            </div>
            
            <div style="margin-bottom: 15px;">
              <label style="display: block; margin-bottom: 5px; font-weight: bold; font-size: 12px;">Category:</label>
              <select id="eventCategory" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; font-size: 12px;">
                <option value="work">Work</option>
                <option value="personal">Personal</option>
                <option value="health">Health</option>
                <option value="social">Social</option>
                <option value="entertainment">Entertainment</option>
                <option value="holiday">Holiday</option>
              </select>
            </div>
            
            <div style="margin-bottom: 15px;">
              <label style="display: block; margin-bottom: 5px; font-weight: bold; font-size: 12px;">Date:</label>
              <input type="date" id="eventDate" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; font-size: 12px;">
            </div>
            
            <div style="display: flex; gap: 10px; margin-bottom: 15px;">
              <div style="flex: 1;">
                <label style="display: block; margin-bottom: 5px; font-weight: bold; font-size: 12px;">Start Time:</label>
                <input type="time" id="eventStartTime" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; font-size: 12px;">
              </div>
              <div style="flex: 1;">
                <label style="display: block; margin-bottom: 5px; font-weight: bold; font-size: 12px;">End Time:</label>
                <input type="time" id="eventEndTime" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; font-size: 12px;">
              </div>
            </div>
            
            <div style="margin-bottom: 15px;">
              <label style="display: block; margin-bottom: 5px; font-weight: bold; font-size: 12px;">Description:</label>
              <textarea id="eventDescription" placeholder="Enter event description (optional)" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; font-size: 12px; height: 60px; resize: vertical;"></textarea>
            </div>
            
            <div style="display: flex; gap: 8px; margin-top: 15px;">
              <button onclick="saveEvent()" style="flex: 1; padding: 10px; background: #28a745; color: white; border: none; border-radius: 4px; font-size: 12px; cursor: pointer;">
                <i class="fas fa-save"></i> Save Event
              </button>
              <button onclick="showPopup('calendar')" style="flex: 1; padding: 10px; background: #6c757d; color: white; border: none; border-radius: 4px; font-size: 12px; cursor: pointer;">
                <i class="fas fa-arrow-left"></i> Back
              </button>
            </div>
          </div>
        `;
        break;
        
      case 'viewAll':
        content = `
          <div style="width: 320px;">
            <h4 style="margin: 0 0 15px 0; color: #0066cc; font-size: 16px; text-align: center;">
              <i class="fas fa-eye"></i> All Events
            </h4>
            
            <div style="margin-bottom: 15px;">
              <input type="text" id="searchEvents" placeholder="Search events..." onkeyup="filterEvents()" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; font-size: 12px; box-sizing: border-box;">
            </div>
            
            <div id="allEventsList" style="max-height: 350px; overflow-y: auto; overflow-x: hidden;">
              ${getAllEvents()}
            </div>
            
            <div style="display: flex; gap: 8px; margin-top: 15px;">
              <button onclick="addEvent()" style="flex: 1; padding: 8px; background: #0066cc; color: white; border: none; border-radius: 4px; font-size: 12px; cursor: pointer;">
                <i class="fas fa-plus"></i> Add Event
              </button>
              <button onclick="showPopup('calendar')" style="flex: 1; padding: 8px; background: #6c757d; color: white; border: none; border-radius: 4px; font-size: 12px; cursor: pointer;">
                <i class="fas fa-arrow-left"></i> Back
              </button>
            </div>
          </div>
        `;
        break;
      
      case 'note':
        content = `
          <div style="width: 320px;">
            <h4 style="margin: 0 0 15px 0; color: #0066cc; font-size: 16px; text-align: center;">
              <i class="fas fa-sticky-note"></i> Notes
            </h4>
            
            <div style="margin-bottom: 15px;">
              <button onclick="addNote()" style="width: 100%; padding: 10px; background: #28a745; color: white; border: none; border-radius: 4px; font-size: 12px; cursor: pointer;">
                <i class="fas fa-plus"></i> Add New Note
              </button>
            </div>
            
            <div id="notesList" style="max-height: 350px; overflow-y: auto; overflow-x: hidden;">
              ${getNotesList()}
            </div>
            
            <div style="margin-top: 15px; text-align: center;">
              <small style="color: #666; font-size: 11px;">Total Notes: ${notes.length}</small>
            </div>
          </div>
        `;
        break;
        
      case 'task':
        content = `
          <div style="width: 320px;">
            <h4 style="margin: 0 0 15px 0; color: #0066cc; font-size: 16px; text-align: center;">
              <i class="fas fa-check-circle"></i> Tasks
            </h4>
            
            <div style="margin-bottom: 15px; display: flex; gap: 8px;">
              <button onclick="addTask()" style="flex: 1; padding: 8px; background: #28a745; color: white; border: none; border-radius: 4px; font-size: 12px; cursor: pointer;">
                <i class="fas fa-plus"></i> Add Task
              </button>
              <select id="taskFilter" onchange="filterTasks()" style="flex: 1; padding: 8px; border: 1px solid #ddd; border-radius: 4px; font-size: 12px;">
                <option value="all">All Tasks</option>
                <option value="pending">Pending</option>
                <option value="in-progress">In Progress</option>
                <option value="completed">Completed</option>
              </select>
            </div>
            
            <div id="tasksList" style="max-height: 350px; overflow-y: auto; overflow-x: hidden;">
              ${getTasksList()}
            </div>
            
            <div style="margin-top: 15px; text-align: center;">
              <small style="color: #666; font-size: 11px;">
                Pending: ${tasks.filter(t => t.status === 'pending').length} | 
                In Progress: ${tasks.filter(t => t.status === 'in-progress').length} | 
                Completed: ${tasks.filter(t => t.status === 'completed').length}
              </small>
            </div>
          </div>
        `;
        break;
        
      case 'chat':
        content = `
          <div style="width: 320px;">
            <h4 style="margin: 0 0 15px 0; color: #0066cc; font-size: 16px; text-align: center;">
              <i class="fas fa-comments"></i> Chat
            </h4>
            
            ${selectedManager ? getChatWithManager() : getManagersList()}
          </div>
        `;
        break;
        
      case 'gmail':
        content = `
          <div style="width: 320px;">
            <h4 style="margin: 0 0 15px 0; color: #0066cc; font-size: 16px; text-align: center;">
              <i class="fas fa-envelope"></i> Gmail
            </h4>
            
            <div style="margin-bottom: 15px; display: flex; gap: 8px;">
              <button onclick="composeEmail()" style="flex: 1; padding: 8px; background: #dc3545; color: white; border: none; border-radius: 4px; font-size: 12px; cursor: pointer;">
                <i class="fas fa-edit"></i> Compose
              </button>
              <button onclick="refreshEmails()" style="padding: 8px 12px; background: #6c757d; color: white; border: none; border-radius: 4px; font-size: 12px; cursor: pointer;">
                <i class="fas fa-refresh"></i>
              </button>
            </div>
            
            <div id="emailsList" style="max-height: 350px; overflow-y: auto; overflow-x: hidden;">
              ${getEmailsList()}
            </div>
            
            <div style="margin-top: 15px; text-align: center;">
              <small style="color: #666; font-size: 11px;">
                Unread: ${emails.filter(e => !e.isRead).length} | 
                Total: ${emails.length}
              </small>
            </div>
          </div>
        `;
        break;
        
      case 'addon':
        content = `<h4><i class="fas fa-plus"></i> Add More</h4><p>Additional features will appear here...</p>`;
        break;
        
      case 'addNote':
        content = `
          <div style="width: 320px;">
            <h4 style="margin: 0 0 15px 0; color: #0066cc; font-size: 16px; text-align: center;">
              <i class="fas fa-plus"></i> Add New Note
            </h4>
            
            <div style="margin-bottom: 15px;">
              <label style="display: block; margin-bottom: 5px; font-weight: bold; font-size: 12px;">Note Title:</label>
              <input type="text" id="noteTitle" placeholder="Enter note title" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; font-size: 12px; box-sizing: border-box;">
            </div>
            
            <div style="margin-bottom: 15px;">
              <label style="display: block; margin-bottom: 5px; font-weight: bold; font-size: 12px;">Category:</label>
              <select id="noteCategory" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; font-size: 12px; box-sizing: border-box;">
                <option value="personal">Personal</option>
                <option value="work">Work</option>
                <option value="learning">Learning</option>
                <option value="ideas">Ideas</option>
                <option value="reminders">Reminders</option>
              </select>
            </div>
            
            <div style="margin-bottom: 15px;">
              <label style="display: block; margin-bottom: 5px; font-weight: bold; font-size: 12px;">Priority:</label>
              <select id="notePriority" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; font-size: 12px; box-sizing: border-box;">
                <option value="low">Low</option>
                <option value="medium" selected>Medium</option>
                <option value="high">High</option>
              </select>
            </div>
            
            <div style="margin-bottom: 15px;">
              <label style="display: block; margin-bottom: 5px; font-weight: bold; font-size: 12px;">Content:</label>
              <textarea id="noteContent" placeholder="Enter note content..." style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; font-size: 12px; height: 120px; resize: vertical; box-sizing: border-box;"></textarea>
            </div>
            
            <div style="display: flex; gap: 8px; margin-top: 15px;">
              <button onclick="saveNote()" style="flex: 1; padding: 10px; background: #28a745; color: white; border: none; border-radius: 4px; font-size: 12px; cursor: pointer;">
                <i class="fas fa-save"></i> Save Note
              </button>
              <button onclick="showPopup('note')" style="flex: 1; padding: 10px; background: #6c757d; color: white; border: none; border-radius: 4px; font-size: 12px; cursor: pointer;">
                <i class="fas fa-arrow-left"></i> Back
              </button>
            </div>
          </div>
        `;
        break;
        
      case 'addTask':
        content = `
          <div style="width: 320px;">
            <h4 style="margin: 0 0 15px 0; color: #0066cc; font-size: 16px; text-align: center;">
              <i class="fas fa-plus"></i> Add New Task
            </h4>
            
            <div style="margin-bottom: 15px;">
              <label style="display: block; margin-bottom: 5px; font-weight: bold; font-size: 12px;">Task Title:</label>
              <input type="text" id="taskTitle" placeholder="Enter task title" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; font-size: 12px; box-sizing: border-box;">
            </div>
            
            <div style="margin-bottom: 15px;">
              <label style="display: block; margin-bottom: 5px; font-weight: bold; font-size: 12px;">Description:</label>
              <textarea id="taskDescription" placeholder="Enter task description..." style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; font-size: 12px; height: 80px; resize: vertical; box-sizing: border-box;"></textarea>
            </div>
            
            <div style="margin-bottom: 15px;">
              <label style="display: block; margin-bottom: 5px; font-weight: bold; font-size: 12px;">Due Date:</label>
              <input type="date" id="taskDueDate" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; font-size: 12px; box-sizing: border-box;">
            </div>
            
            <div style="display: flex; gap: 10px; margin-bottom: 15px;">
              <div style="flex: 1;">
                <label style="display: block; margin-bottom: 5px; font-weight: bold; font-size: 12px;">Priority:</label>
                <select id="taskPriority" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; font-size: 12px; box-sizing: border-box;">
                  <option value="low">Low</option>
                  <option value="medium" selected>Medium</option>
                  <option value="high">High</option>
                </select>
              </div>
              <div style="flex: 1;">
                <label style="display: block; margin-bottom: 5px; font-weight: bold; font-size: 12px;">Category:</label>
                <select id="taskCategory" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; font-size: 12px; box-sizing: border-box;">
                  <option value="personal">Personal</option>
                  <option value="work">Work</option>
                  <option value="health">Health</option>
                  <option value="learning">Learning</option>
                  <option value="shopping">Shopping</option>
                </select>
              </div>
            </div>
            
            <div style="margin-bottom: 15px;">
              <label style="display: block; margin-bottom: 5px; font-weight: bold; font-size: 12px;">Status:</label>
              <select id="taskStatus" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; font-size: 12px; box-sizing: border-box;">
                <option value="pending" selected>Pending</option>
                <option value="in-progress">In Progress</option>
                <option value="completed">Completed</option>
              </select>
            </div>
            
            <div style="display: flex; gap: 8px; margin-top: 15px;">
              <button onclick="saveTask()" style="flex: 1; padding: 10px; background: #28a745; color: white; border: none; border-radius: 4px; font-size: 12px; cursor: pointer;">
                <i class="fas fa-save"></i> Save Task
              </button>
              <button onclick="showPopup('task')" style="flex: 1; padding: 10px; background: #6c757d; color: white; border: none; border-radius: 4px; font-size: 12px; cursor: pointer;">
                <i class="fas fa-arrow-left"></i> Back
              </button>
            </div>
          </div>
        `;
        break;
        
      case 'composeEmail':
        content = `
          <div style="width: 350px;">
            <h4 style="margin: 0 0 15px 0; color: #0066cc; font-size: 16px; text-align: center;">
              <i class="fas fa-edit"></i> Compose Email
            </h4>
            
            <div style="margin-bottom: 15px;">
              <label style="display: block; margin-bottom: 5px; font-weight: bold; font-size: 12px;">To:</label>
              <input type="email" id="emailTo" placeholder="Enter recipient email" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; font-size: 12px; box-sizing: border-box;">
            </div>
            
            <div style="margin-bottom: 15px;">
              <label style="display: block; margin-bottom: 5px; font-weight: bold; font-size: 12px;">Subject:</label>
              <input type="text" id="emailSubject" placeholder="Enter email subject" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; font-size: 12px; box-sizing: border-box;">
            </div>
            
            <div style="margin-bottom: 15px;">
              <label style="display: block; margin-bottom: 5px; font-weight: bold; font-size: 12px;">Message:</label>
              <textarea id="emailBody" placeholder="Enter your message..." style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; font-size: 12px; height: 150px; resize: vertical; box-sizing: border-box;"></textarea>
            </div>
            
            <div style="display: flex; gap: 8px; margin-top: 15px;">
              <button onclick="sendEmail()" style="flex: 1; padding: 10px; background: #dc3545; color: white; border: none; border-radius: 4px; font-size: 12px; cursor: pointer;">
                <i class="fas fa-paper-plane"></i> Send Email
              </button>
              <button onclick="showPopup('gmail')" style="flex: 1; padding: 10px; background: #6c757d; color: white; border: none; border-radius: 4px; font-size: 12px; cursor: pointer;">
                <i class="fas fa-arrow-left"></i> Back
              </button>
            </div>
          </div>
        `;
        break;
    }
    
    title.innerHTML = content;
    popup.classList.remove('hidden');
    
    // Set current month and year in selects
    if (type === 'calendar') {
      document.getElementById('monthSelect').value = currentMonth;
      document.getElementById('yearSelect').value = currentYear;
    }
  }

  function closePopup() {
    const popup = document.getElementById('popup-container');
    popup.classList.add('hidden');
  }

  function togglePanel() {
    const panel = document.getElementById('side-panel');
    const toggleBtn = document.getElementById('toggle-btn');
    
    // Toggle the show class for dropdown animation
    panel.classList.toggle('show');
    
    // Toggle the active class on button for arrow rotation
    toggleBtn.classList.toggle('active');
    
    // Update arrow direction
    const arrow = toggleBtn.querySelector('.arrow');
    if (panel.classList.contains('show')) {
      arrow.textContent = '▲';
    } else {
      arrow.textContent = '▼';
    }
  }

  function getDominantCategory(dayEvents) {
    const categoryCounts = {};
    dayEvents.forEach(event => {
      categoryCounts[event.category] = (categoryCounts[event.category] || 0) + 1;
    });
    
    return Object.keys(categoryCounts).reduce((a, b) => categoryCounts[a] > categoryCounts[b] ? a : b);
  }

  function getEventTooltip(dayEvents) {
    if (dayEvents.length === 0) return '';
    
    return dayEvents.map(event => `${event.title} (${event.time})`).join('\n');
  }

  function getAllEvents() {
    let allEvents = '';
    const sortedDates = Object.keys(events).sort();
    
    if (sortedDates.length === 0) {
      return '<p style="color: #666; font-size: 12px; text-align: center;">No events found</p>';
    }
    
    sortedDates.forEach(dateStr => {
      const eventDate = new Date(dateStr);
      const formattedDate = eventDate.toLocaleDateString('en-US', { 
        weekday: 'short', 
        year: 'numeric', 
        month: 'short', 
        day: 'numeric' 
      });
      
      const dayEvents = events[dateStr];
      
      allEvents += `
        <div style="margin-bottom: 15px; padding: 12px; border: 1px solid #eee; border-radius: 8px; background: #f9f9f9;">
          <h6 style="margin: 0 0 10px 0; color: #0066cc; font-size: 13px; font-weight: bold;">${formattedDate}</h6>
          ${dayEvents.map(event => {
            const categoryStyle = categoryStyles[event.category];
            return `
              <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px; padding: 6px 8px; background: ${categoryStyle.bg}; border-radius: 4px; border-left: 3px solid ${categoryStyle.color}; word-wrap: break-word; overflow-wrap: break-word;">
                <div style="display: flex; align-items: center; flex: 1; min-width: 0;">
                  <i class="${categoryStyle.icon}" style="color: ${categoryStyle.color}; margin-right: 8px; font-size: 12px; flex-shrink: 0;"></i>
                  <div style="flex: 1; min-width: 0;">
                    <div style="font-size: 12px; font-weight: bold; color: ${categoryStyle.color}; word-wrap: break-word;">${event.title}</div>
                    <div style="font-size: 10px; color: #666; word-wrap: break-word;">${event.time} • ${event.category}</div>
                  </div>
                </div>
                <button onclick="deleteEvent('${dateStr}', '${event.title}')" style="background: #dc3545; color: white; border: none; border-radius: 3px; padding: 4px 6px; font-size: 10px; cursor: pointer; flex-shrink: 0; margin-left: 8px;">
                  <i class="fas fa-trash"></i>
                </button>
              </div>
            `;
          }).join('')}
        </div>
      `;
    });
    
    return allEvents;
  }

  function generateYearOptions() {
    let options = '';
    for (let year = 2020; year <= 2030; year++) {
      options += `<option value="${year}">${year}</option>`;
    }
    return options;
  }

  function changeMonth(direction) {
    currentMonth += direction;
    if (currentMonth > 11) {
      currentMonth = 0;
      currentYear++;
    } else if (currentMonth < 0) {
      currentMonth = 11;
      currentYear--;
    }
    updateCalendar();
  }

  function changeMonthYear() {
    currentMonth = parseInt(document.getElementById('monthSelect').value);
    currentYear = parseInt(document.getElementById('yearSelect').value);
    updateCalendar();
  }

  function updateCalendar() {
    const calendarGrid = document.getElementById('calendarGrid');
    if (calendarGrid) {
      calendarGrid.innerHTML = `
        <div style="text-align: center; font-weight: bold; color: #666; padding: 8px; font-size: 12px;">Sun</div>
        <div style="text-align: center; font-weight: bold; color: #666; padding: 8px; font-size: 12px;">Mon</div>
        <div style="text-align: center; font-weight: bold; color: #666; padding: 8px; font-size: 12px;">Tue</div>
        <div style="text-align: center; font-weight: bold; color: #666; padding: 8px; font-size: 12px;">Wed</div>
        <div style="text-align: center; font-weight: bold; color: #666; padding: 8px; font-size: 12px;">Thu</div>
        <div style="text-align: center; font-weight: bold; color: #666; padding: 8px; font-size: 12px;">Fri</div>
        <div style="text-align: center; font-weight: bold; color: #666; padding: 8px; font-size: 12px;">Sat</div>
        ${generateCalendarDays()}
      `;
      
      document.getElementById('monthSelect').value = currentMonth;
      document.getElementById('yearSelect').value = currentYear;
      
      const todayActivities = document.getElementById('todayActivities');
      if (todayActivities) {
        todayActivities.innerHTML = getTodayActivities();
      }
    }
  }

  function selectDate(day) {
    const selectedDate = `${currentYear}-${String(currentMonth + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
    console.log('Selected date:', selectedDate);
    
    // Set the date in add event form if it's open
    const eventDate = document.getElementById('eventDate');
    if (eventDate) {
      eventDate.value = selectedDate;
    }
  }

  function addEvent() {
    showPopup('addEvent');
  }

  function saveEvent() {
    const title = document.getElementById('eventTitle').value;
    const date = document.getElementById('eventDate').value;
    const startTime = document.getElementById('eventStartTime').value;
    const endTime = document.getElementById('eventEndTime').value;
    const category = document.getElementById('eventCategory').value;
    const description = document.getElementById('eventDescription').value;
    
    if (!title || !date) {
      alert('Please fill in event title and date');
      return;
    }
    
    if (!events[date]) {
      events[date] = [];
    }
    
    let timeText = 'All Day';
    if (startTime && endTime) {
      timeText = `${startTime}-${endTime}`;
    } else if (startTime) {
      timeText = `${startTime}`;
    }
    
    const newEvent = {
      title: title,
      category: category,
      time: timeText,
      description: description
    };
    
    events[date].push(newEvent);
    
    alert('Event saved successfully!');
    showPopup('calendar');
  }

  function viewAll() {
    showPopup('viewAll');
  }

  function deleteEvent(dateStr, eventTitle) {
    if (confirm('Are you sure you want to delete this event?')) {
      events[dateStr] = events[dateStr].filter(event => event.title !== eventTitle);
      if (events[dateStr].length === 0) {
        delete events[dateStr];
      }
      showPopup('viewAll');
    }
  }

  // Add these data structures at the top of your script section (after the events object)
  let notes = [
    {
      id: 1,
      title: 'Meeting Notes',
      content: 'Important points discussed in today\'s meeting: 1. Project deadline moved to next week 2. Need to review budget allocation 3. Team building event planned for next month',
      category: 'work',
      priority: 'high',
      date: '2024-07-22'
    },
    {
      id: 2,
      title: 'Shopping List',
      content: 'Groceries needed: milk, bread, eggs, vegetables, fruits, chicken, rice, pasta, coffee, sugar',
      category: 'personal',
      priority: 'medium',
      date: '2024-07-21'
    },
    {
      id: 3,
      title: 'Book Ideas',
      content: 'Books to read: "The Psychology of Money", "Atomic Habits", "Clean Code", "Design Patterns"',
      category: 'learning',
      priority: 'low',
      date: '2024-07-20'
    }
  ];

  let tasks = [
    {
      id: 1,
      title: 'Complete Project Report',
      description: 'Finish the quarterly project report with all metrics and analysis',
      dueDate: '2024-07-25',
      priority: 'high',
      category: 'work',
      status: 'in-progress'
    },
    {
      id: 2,
      title: 'Gym Workout',
      description: 'Cardio and strength training session',
      dueDate: '2024-07-23',
      priority: 'medium',
      category: 'health',
      status: 'pending'
    },
    {
      id: 3,
      title: 'Buy Birthday Gift',
      description: 'Find and purchase birthday gift for sister',
      dueDate: '2024-07-24',
      priority: 'high',
      category: 'personal',
      status: 'pending'
    },
    {
      id: 4,
      title: 'Review Code',
      description: 'Review pull request from team member',
      dueDate: '2024-07-22',
      priority: 'medium',
      category: 'work',
      status: 'completed'
    }
  ];

  let chatManagers = [
    {
      id: 1,
      name: 'John Smith',
      position: 'Project Manager',
      avatar: '👨‍💼',
      status: 'online',
      lastSeen: '2 min ago'
    },
    {
      id: 2,
      name: 'Sarah Johnson',
      position: 'Team Lead',
      avatar: '👩‍💼',
      status: 'away',
      lastSeen: '15 min ago'
    },
    {
      id: 3,
      name: 'Mike Wilson',
      position: 'Senior Developer',
      avatar: '👨‍💻',
      status: 'offline',
      lastSeen: '2 hours ago'
    },
    {
      id: 4,
      name: 'Emily Davis',
      position: 'Designer',
      avatar: '👩‍🎨',
      status: 'online',
      lastSeen: 'Just now'
    }
  ];

  let chatMessages = {
    1: [
      {
        id: 1,
        sender: 'John Smith',
        message: 'Hi! How is the project progressing?',
        timestamp: '2024-07-22 14:30',
        type: 'received',
        read: false
      },
      {
        id: 2,
        sender: 'You',
        message: 'Good progress! Almost done with the current phase.',
        timestamp: '2024-07-22 14:32',
        type: 'sent'
      },
      {
        id: 3,
        sender: 'John Smith',
        message: 'Great! Let me know if you need any help.',
        timestamp: '2024-07-22 14:33',
        type: 'received',
        read: false
      }
    ],
    2: [
      {
        id: 1,
        sender: 'Sarah Johnson',
        message: 'Team meeting rescheduled to 3 PM today.',
        timestamp: '2024-07-22 13:15',
        type: 'received',
        read: true
      },
      {
        id: 2,
        sender: 'You',
        message: 'Noted. Thanks for the update!',
        timestamp: '2024-07-22 13:16',
        type: 'sent'
      }
    ],
    4: [
      {
        id: 1,
        sender: 'Emily Davis',
        message: 'Can you review the new UI mockups?',
        timestamp: '2024-07-22 12:45',
        type: 'received',
        read: false
      }
    ]
  };

  let selectedManager = null;

  let emails = [
    {
      id: 1,
      sender: 'client@company.com',
      subject: 'Project Update Required',
      preview: 'Hi, could you please send the latest project status report? We need to review the progress before the next meeting. The deadline is approaching and we want to ensure everything is on track.',
      timestamp: '2024-07-22 14:30',
      isRead: false,
      isImportant: true
    },
    {
      id: 2,
      sender: 'team@company.com',
      subject: 'Team Meeting Tomorrow',
      preview: 'Reminder: Team meeting scheduled for tomorrow at 10 AM in Conference Room A. Please prepare your status updates and bring any blockers to discuss.',
      timestamp: '2024-07-22 13:15',
      isRead: true,
      isImportant: false
    },
    {
      id: 3,
      sender: 'hr@company.com',
      subject: 'Timesheet Submission',
      preview: 'Please submit your timesheet by end of day today. Late submissions will affect your payroll processing.',
      timestamp: '2024-07-22 12:00',
      isRead: false,
      isImportant: false
    },
    {
      id: 4,
      sender: 'support@vendor.com',
      subject: 'Software License Renewal',
      preview: 'Your software license is expiring in 30 days. Please renew to avoid service interruption. Click here to renew now.',
      timestamp: '2024-07-22 11:45',
      isRead: true,
      isImportant: true
    },
    {
      id: 5,
      sender: 'newsletter@tech.com',
      subject: 'Weekly Tech Newsletter',
      preview: 'This week in tech: AI breakthroughs, new JavaScript frameworks, and cloud computing trends. Read the full newsletter.',
      timestamp: '2024-07-22 09:30',
      isRead: false,
      isImportant: false
    }
  ];

  // Update the existing functions with proper implementations

  function getNotesList() {
    if (notes.length === 0) {
      return '<p style="color: #666; font-size: 12px; text-align: center; padding: 20px;">No notes found</p>';
    }
    
    let notesList = '';
    notes.forEach(note => {
      const priorityColor = note.priority === 'high' ? '#dc3545' : note.priority === 'medium' ? '#ffc107' : '#28a745';
      const categoryIcon = note.category === 'work' ? 'fas fa-briefcase' : 
                          note.category === 'personal' ? 'fas fa-user' : 
                          note.category === 'learning' ? 'fas fa-book' : 
                          note.category === 'ideas' ? 'fas fa-lightbulb' : 'fas fa-bell';
      
      notesList += `
        <div style="margin-bottom: 12px; padding: 12px; border: 1px solid #eee; border-radius: 8px; background: #f9f9f9;">
          <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 8px;">
            <div style="flex: 1;">
              <div style="font-size: 13px; font-weight: bold; color: #333; margin-bottom: 4px;">${note.title}</div>
              <div style="font-size: 11px; color: #666; margin-bottom: 6px;">
                <i class="${categoryIcon}" style="margin-right: 4px;"></i>${note.category}
                <span style="margin-left: 10px; color: ${priorityColor};">
                  <i class="fas fa-circle" style="font-size: 8px; margin-right: 4px;"></i>${note.priority}
                </span>
              </div>
            </div>
            <button onclick="deleteNote(${note.id})" style="background: #dc3545; color: white; border: none; border-radius: 3px; padding: 4px 6px; font-size: 10px; cursor: pointer;">
              <i class="fas fa-trash"></i>
            </button>
          </div>
          <div style="font-size: 11px; color: #555; line-height: 1.4; margin-bottom: 6px;">${note.content.substring(0, 100)}${note.content.length > 100 ? '...' : ''}</div>
          <div style="font-size: 10px; color: #999;">${note.date}</div>
        </div>
      `;
    });
    
    return notesList;
  }

  function getTasksList() {
    if (tasks.length === 0) {
      return '<p style="color: #666; font-size: 12px; text-align: center; padding: 20px;">No tasks found</p>';
    }
    
    let tasksList = '';
    tasks.forEach(task => {
      const priorityColor = task.priority === 'high' ? '#dc3545' : task.priority === 'medium' ? '#ffc107' : '#28a745';
      const statusColor = task.status === 'completed' ? '#28a745' : task.status === 'in-progress' ? '#ffc107' : '#6c757d';
      const statusIcon = task.status === 'completed' ? 'fas fa-check-circle' : task.status === 'in-progress' ? 'fas fa-clock' : 'fas fa-circle';
      
      tasksList += `
        <div style="margin-bottom: 12px; padding: 12px; border: 1px solid #eee; border-radius: 8px; background: #f9f9f9;">
          <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 8px;">
            <div style="flex: 1;">
              <div style="font-size: 13px; font-weight: bold; color: #333; margin-bottom: 4px;">${task.title}</div>
              <div style="font-size: 11px; color: #666; margin-bottom: 6px;">
                <i class="${statusIcon}" style="color: ${statusColor}; margin-right: 4px;"></i>${task.status}
                <span style="margin-left: 10px; color: ${priorityColor};">
                  <i class="fas fa-exclamation-triangle" style="font-size: 8px; margin-right: 4px;"></i>${task.priority}
                </span>
              </div>
            </div>
            <div style="display: flex; gap: 4px;">
              <button onclick="toggleTaskStatus(${task.id})" style="background: ${statusColor}; color: white; border: none; border-radius: 3px; padding: 4px 6px; font-size: 10px; cursor: pointer;">
                <i class="fas fa-sync"></i>
              </button>
              <button onclick="deleteTask(${task.id})" style="background: #dc3545; color: white; border: none; border-radius: 3px; padding: 4px 6px; font-size: 10px; cursor: pointer;">
                <i class="fas fa-trash"></i>
              </button>
            </div>
          </div>
          <div style="font-size: 11px; color: #555; line-height: 1.4; margin-bottom: 6px;">${task.description}</div>
          <div style="font-size: 10px; color: #999;">Due: ${task.dueDate} | ${task.category}</div>
        </div>
      `;
    });
    
    return tasksList;
  }

  function getManagersList() {
    let managersList = `
      <div style="margin-bottom: 15px;">
        <input type="text" id="searchManagers" placeholder="Search managers..." onkeyup="filterManagers()" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; font-size: 12px; box-sizing: border-box;">
      </div>
      <div id="managersListContainer">
    `;
    
    chatManagers.forEach(manager => {
      const statusColor = manager.status === 'online' ? '#28a745' : manager.status === 'away' ? '#ffc107' : '#6c757d';
      const unreadCount = chatMessages[manager.id] ? chatMessages[manager.id].filter(msg => msg.type === 'received' && !msg.read).length : 0;
      
      managersList += `
        <div class="manager-item" data-name="${manager.name.toLowerCase()}" data-position="${manager.position.toLowerCase()}" onclick="selectManager(${manager.id})" style="display: flex; align-items: center; padding: 12px; border: 1px solid #eee; border-radius: 8px; margin-bottom: 8px; cursor: pointer; background: #f9f9f9; transition: background 0.2s;">
          <div style="font-size: 24px; margin-right: 12px;">${manager.avatar}</div>
          <div style="flex: 1;">
            <div style="font-size: 13px; font-weight: bold; color: #333; margin-bottom: 2px;">${manager.name}</div>
            <div style="font-size: 11px; color: #666; margin-bottom: 4px;">${manager.position}</div>
            <div style="font-size: 10px; color: ${statusColor};">
              <i class="fas fa-circle" style="font-size: 8px; margin-right: 4px;"></i>${manager.status} - ${manager.lastSeen}
            </div>
          </div>
          ${unreadCount > 0 ? `<div style="background: #dc3545; color: white; border-radius: 50%; width: 20px; height: 20px; display: flex; align-items: center; justify-content: center; font-size: 10px;">${unreadCount}</div>` : ''}
        </div>
      `;
    });
    
    managersList += '</div>';
    return managersList;
  }

  // Add this new function for filtering managers
  function filterManagers() {
    const searchTerm = document.getElementById('searchManagers').value.toLowerCase();
    const managerItems = document.querySelectorAll('.manager-item');
    
    managerItems.forEach(item => {
      const name = item.getAttribute('data-name');
      const position = item.getAttribute('data-position');
      
      if (name.includes(searchTerm) || position.includes(searchTerm)) {
        item.style.display = 'flex';
      } else {
        item.style.display = 'none';
      }
    });
  }

  function getChatWithManager() {
    const manager = chatManagers.find(m => m.id === selectedManager);
    const messages = chatMessages[selectedManager] || [];
    
    let chatContent = `
      <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
        <div style="display: flex; align-items: center; flex: 1;">
          <button onclick="backToManagers()" style="background: none; border: none; color: #0066cc; font-size: 16px; cursor: pointer; margin-right: 10px; padding: 8px; border-radius: 50%; transition: all 0.2s ease;" onmouseover="this.style.background='#f8f9fa'" onmouseout="this.style.background='none'">
            <i class="fas fa-arrow-left"></i>
          </button>
          <div style="font-size: 20px; margin-right: 10px;">${manager.avatar}</div>
          <div>
            <div style="font-size: 14px; font-weight: bold; color: #333;">${manager.name}</div>
            <div style="font-size: 11px; color: #666;">${manager.position}</div>
          </div>
        </div>
      </div>
      
      <div id="chatMessages" style="max-height: 250px; overflow-y: auto; margin-bottom: 15px; padding: 10px; border: 1px solid #eee; border-radius: 8px; background: #f9f9f9;">
    `;
    
    messages.forEach(message => {
      const isReceived = message.type === 'received';
      const alignStyle = isReceived ? 'flex-start' : 'flex-end';
      const bgColor = isReceived ? '#e9ecef' : '#0066cc';
      const textColor = isReceived ? '#333' : 'white';
      
      chatContent += `
        <div style="display: flex; justify-content: ${alignStyle}; margin-bottom: 8px;">
          <div style="background: ${bgColor}; color: ${textColor}; padding: 8px 12px; border-radius: 12px; max-width: 80%; font-size: 12px;">
            <div>${message.message}</div>
            <div style="font-size: 10px; opacity: 0.7; margin-top: 4px;">${message.timestamp.split(' ')[1]}</div>
          </div>
        </div>
      `;
    });
    
    chatContent += `
    </div>
    
    <div style="display: flex; gap: 8px;">
      <input type="text" id="chatInput" placeholder="Type a message..." style="flex: 1; padding: 8px; border: 1px solid #ddd; border-radius: 4px; font-size: 12px;" onkeypress="if(event.key==='Enter') sendMessage()">
      <button onclick="sendMessage()" style="padding: 8px 12px; background: #0066cc; color: white; border: none; border-radius: 4px; font-size: 12px; cursor: pointer; transition: all 0.2s ease;" onmouseover="this.style.background='#0052a3'" onmouseout="this.style.background='#0066cc'">
        <i class="fas fa-paper-plane"></i>
      </button>
    </div>
  `;
    
    return chatContent;
  }

  function getEmailsList() {
    if (emails.length === 0) {
      return '<p style="color: #666; font-size: 12px; text-align: center; padding: 20px;">No emails found</p>';
    }
    
    let emailsList = '';
    emails.forEach(email => {
      const readStyle = email.isRead ? 'color: #666;' : 'color: #333; font-weight: bold;';
      const importantIcon = email.isImportant ? '<i class="fas fa-star" style="color: #ffc107; margin-right: 4px;"></i>' : '';
      
      emailsList += `
        <div onclick="openEmail(${email.id})" style="padding: 12px; border: 1px solid #eee; border-radius: 8px; margin-bottom: 8px; cursor: pointer; background: #f9f9f9; transition: background 0.2s;">
          <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 4px;">
            <div style="flex: 1; ${readStyle}">
              ${importantIcon}<strong>${email.sender}</strong>
            </div>
            <div style="font-size: 10px; color: #999;">${new Date(email.timestamp).toLocaleString()}</div>
          </div>
          <div style="font-size: 12px; ${readStyle} margin-bottom: 4px;">${email.subject}</div>
          <div style="font-size: 11px; color: #666; line-height: 1.4;">${email.preview.substring(0, 80)}${email.preview.length > 80 ? '...' : ''}</div>
        </div>
      `;
    });
    
    return emailsList;
  }

  // Add these supporting functions
  function selectManager(managerId) {
    selectedManager = managerId;
    // Mark messages as read
    if (chatMessages[managerId]) {
      chatMessages[managerId].forEach(msg => {
        if (msg.type === 'received') {
          msg.read = true;
        }
      });
    }
    showPopup('chat');
  }



  function backToManagers() {
    selectedManager = null;
    showPopup('chat');
  }

  function sendMessage() {
    const input = document.getElementById('chatInput');
    const message = input.value.trim();
    
    if (!message) return;
    
    const now = new Date();
    const timestamp = now.toISOString().slice(0, 16).replace('T', ' ');
    
    const newMessage = {
      id: Date.now(),
      sender: 'You',
      message: message,
      timestamp: timestamp,
      type: 'sent'
    };
    
    if (!chatMessages[selectedManager]) {
      chatMessages[selectedManager] = [];
    }
    
    chatMessages[selectedManager].push(newMessage);
    input.value = '';
    
    // Auto-scroll to bottom
    setTimeout(() => {
      const chatDiv = document.getElementById('chatMessages');
      if (chatDiv) {
        chatDiv.scrollTop = chatDiv.scrollHeight;
      }
    }, 100);
    
    showPopup('chat');
  }

  function openEmail(emailId) {
    const email = emails.find(e => e.id === emailId);
    if (email) {
      // Mark as read
      email.isRead = true;
      
      const popup = document.getElementById('popup-container');
      const title = document.getElementById('popup-title');
      
      title.innerHTML = `
        <div style="width: 350px;">
          <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
            <button onclick="showPopup('gmail')" style="background: none; border: none; color: #0066cc; font-size: 16px; cursor: pointer; padding: 8px; border-radius: 50%; transition: all 0.2s ease;" onmouseover="this.style.background='#f8f9fa'" onmouseout="this.style.background='none'">
              <i class="fas fa-arrow-left"></i>
            </button>
            <h4 style="margin: 0; color: #0066cc; font-size: 16px; flex: 1; text-align: center;">
              <i class="fas fa-envelope"></i> Email
            </h4>
            <div style="width: 32px;"></div>
          </div>
          
          <div style="margin-bottom: 15px; padding: 15px; border: 1px solid #eee; border-radius: 8px; background: #f9f9f9;">
            <div style="font-size: 14px; font-weight: bold; color: #333; margin-bottom: 8px;">${email.subject}</div>
            <div style="font-size: 12px; color: #666; margin-bottom: 8px;">
              <strong>From:</strong> ${email.sender}<br>
              <strong>Date:</strong> ${new Date(email.timestamp).toLocaleString()}
            </div>
            ${email.isImportant ? '<div style="font-size: 11px; color: #ffc107; margin-bottom: 8px;"><i class="fas fa-star"></i> Important</div>' : ''}
          </div>
          
          <div style="font-size: 13px; color: #333; line-height: 1.6; margin-bottom: 20px; padding: 15px; border: 1px solid #eee; border-radius: 8px; background: white;">
            ${email.preview}
          </div>
          
          <div style="display: flex; gap: 8px;">
            <button onclick="replyEmail(${email.id})" style="flex: 1; padding: 8px; background: #0066cc; color: white; border: none; border-radius: 4px; font-size: 12px; cursor: pointer; transition: all 0.2s ease;" onmouseover="this.style.background='#0052a3'" onmouseout="this.style.background='#0066cc'">
              <i class="fas fa-reply"></i> Reply
            </button>
            <button onclick="forwardEmail(${email.id})" style="flex: 1; padding: 8px; background: #6c757d; color: white; border: none; border-radius: 4px; font-size: 12px; cursor: pointer; transition: all 0.2s ease;" onmouseover="this.style.background='#5a6268'" onmouseout="this.style.background='#6c757d'">
              <i class="fas fa-share"></i> Forward
            </button>
            <button onclick="deleteEmail(${email.id})" style="padding: 8px 12px; background: #dc3545; color: white; border: none; border-radius: 4px; font-size: 12px; cursor: pointer; transition: all 0.2s ease;" onmouseover="this.style.background='#c82333'" onmouseout="this.style.background='#dc3545'">
              <i class="fas fa-trash"></i>
            </button>
          </div>
        </div>
      `;
      
      popup.classList.remove('hidden');
    }
  }

  function replyEmail(emailId) {
    const email = emails.find(e => e.id === emailId);
    showPopup('composeEmail');
    // Pre-fill reply fields
    setTimeout(() => {
      const subjectField = document.getElementById('emailSubject');
      const toField = document.getElementById('emailTo');
      if (subjectField && toField) {
        subjectField.value = 'Re: ' + email.subject;
        toField.value = email.sender;
      }
    }, 100);
  }

  function forwardEmail(emailId) {
    const email = emails.find(e => e.id === emailId);
    showPopup('composeEmail');
    // Pre-fill forward fields
    setTimeout(() => {
      const subjectField = document.getElementById('emailSubject');
      const bodyField = document.getElementById('emailBody');
      if (subjectField && bodyField) {
        subjectField.value = 'Fwd: ' + email.subject;
        bodyField.value = `\n\n--- Forwarded Message ---\nFrom: ${email.sender}\nSubject: ${email.subject}\n\n${email.preview}`;
      }
    }, 100);
  }

  function deleteEmail(emailId) {
    if (confirm('Are you sure you want to delete this email?')) {
      emails = emails.filter(e => e.id !== emailId);
      showPopup('gmail');
    }
  }

  function addNote() {
    showPopup('addNote');
  }

  function saveNote() {
    const title = document.getElementById('noteTitle').value;
    const category = document.getElementById('noteCategory').value;
    const priority = document.getElementById('notePriority').value;
    const content = document.getElementById('noteContent').value;
    
    if (!title || !content) {
      alert('Please fill in note title and content');
      return;
    }
    
    const newNote = {
      id: Date.now(),
      title: title,
      content: content,
      category: category,
      priority: priority,
      date: new Date().toISOString().split('T')[0]
    };
    
    notes.push(newNote);
    
    alert('Note saved successfully!');
    showPopup('note');
  }

  function deleteNote(noteId) {
    if (confirm('Are you sure you want to delete this note?')) {
      notes = notes.filter(note => note.id !== noteId);
      showPopup('note');
    }
  }

  function composeEmail() {
    showPopup('composeEmail');
  }

  function addTask() {
    showPopup('addTask');
  }

  function saveTask() {
    const title = document.getElementById('taskTitle').value;
    const description = document.getElementById('taskDescription').value;
    const dueDate = document.getElementById('taskDueDate').value;
    const priority = document.getElementById('taskPriority').value;
    const category = document.getElementById('taskCategory').value;
    const status = document.getElementById('taskStatus').value;
    
    if (!title || !description) {
      alert('Please fill in task title and description');
      return;
    }
    
    const newTask = {
      id: Date.now(),
      title: title,
      description: description,
      dueDate: dueDate,
      priority: priority,
      category: category,
      status: status
    };
    
    tasks.push(newTask);
    
    alert('Task saved successfully!');
    showPopup('task');
  }

  function deleteTask(taskId) {
    if (confirm('Are you sure you want to delete this task?')) {
      tasks = tasks.filter(task => task.id !== taskId);
      showPopup('task');
    }
  }

  function toggleTaskStatus(taskId) {
    const task = tasks.find(t => t.id === taskId);
    if (task) {
      if (task.status === 'pending') {
        task.status = 'in-progress';
      } else if (task.status === 'in-progress') {
        task.status = 'completed';
      } else {
        task.status = 'pending';
      }
      showPopup('task');
    }
  }

  function filterTasks() {
    const filter = document.getElementById('taskFilter').value;
    const tasksList = document.getElementById('tasksList');
    
    if (filter === 'all') {
      tasksList.innerHTML = getTasksList();
    } else {
      const filteredTasks = tasks.filter(task => task.status === filter);
      tasksList.innerHTML = getFilteredTasksList(filteredTasks);
    }
  }

  function getFilteredTasksList(filteredTasks) {
    if (filteredTasks.length === 0) {
      return '<p style="color: #666; font-size: 12px; text-align: center; padding: 20px;">No tasks found for this filter</p>';
    }
    
    let tasksList = '';
    filteredTasks.forEach(task => {
      const priorityColor = task.priority === 'high' ? '#dc3545' : task.priority === 'medium' ? '#ffc107' : '#28a745';
      const statusColor = task.status === 'completed' ? '#28a745' : task.status === 'in-progress' ? '#ffc107' : '#6c757d';
      const statusIcon = task.status === 'completed' ? 'fas fa-check-circle' : task.status === 'in-progress' ? 'fas fa-clock' : 'fas fa-circle';
      
      tasksList += `
        <div style="margin-bottom: 12px; padding: 12px; border: 1px solid #eee; border-radius: 8px; background: #f9f9f9;">
          <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 8px;">
            <div style="flex: 1;">
              <div style="font-size: 13px; font-weight: bold; color: #333; margin-bottom: 4px;">${task.title}</div>
              <div style="font-size: 11px; color: #666; margin-bottom: 6px;">
                <i class="${statusIcon}" style="color: ${statusColor}; margin-right: 4px;"></i>${task.status}
                <span style="margin-left: 10px; color: ${priorityColor};">
                  <i class="fas fa-exclamation-triangle" style="font-size: 8px; margin-right: 4px;"></i>${task.priority}
                </span>
              </div>
            </div>
            <div style="display: flex; gap: 4px;">
              <button onclick="toggleTaskStatus(${task.id})" style="background: ${statusColor}; color: white; border: none; border-radius: 3px; padding: 4px 6px; font-size: 10px; cursor: pointer;">
                <i class="fas fa-sync"></i>
              </button>
              <button onclick="deleteTask(${task.id})" style="background: #dc3545; color: white; border: none; border-radius: 3px; padding: 4px 6px; font-size: 10px; cursor: pointer;">
                <i class="fas fa-trash"></i>
              </button>
            </div>
          </div>
          <div style="font-size: 11px; color: #555; line-height: 1.4; margin-bottom: 6px;">${task.description}</div>
          <div style="font-size: 10px; color: #999;">Due: ${task.dueDate} | ${task.category}</div>
        </div>
      `;
    });
    
    return tasksList;
  }

  function refreshEmails() {
    // Simulate refreshing emails
    alert('Emails refreshed!');
    showPopup('gmail');
  }

  function sendEmail() {
    const to = document.getElementById('emailTo').value;
    const subject = document.getElementById('emailSubject').value;
    const body = document.getElementById('emailBody').value;
    
    if (!to || !subject || !body) {
      alert('Please fill in all email fields');
      return;
    }
    
    // Add to sent emails or simulate sending
    alert('Email sent successfully!');
    showPopup('gmail');
  }

  function filterEvents() {
    const searchTerm = document.getElementById('searchEvents').value.toLowerCase();
    const eventsList = document.getElementById('allEventsList');
    
    if (!searchTerm) {
      eventsList.innerHTML = getAllEvents();
      return;
    }
    
    let filteredEvents = '';
    const sortedDates = Object.keys(events).sort();
    
    sortedDates.forEach(dateStr => {
      const eventDate = new Date(dateStr);
      const formattedDate = eventDate.toLocaleDateString('en-US', { 
        weekday: 'short', 
        year: 'numeric', 
        month: 'short', 
        day: 'numeric' 
      });
      
      const dayEvents = events[dateStr].filter(event => 
        event.title.toLowerCase().includes(searchTerm) || 
        event.category.toLowerCase().includes(searchTerm)
      );
      
      if (dayEvents.length > 0) {
        filteredEvents += `
          <div style="margin-bottom: 15px; padding: 12px; border: 1px solid #eee; border-radius: 8px; background: #f9f9f9;">
            <h6 style="margin: 0 0 10px 0; color: #0066cc; font-size: 13px; font-weight: bold;">${formattedDate}</h6>
            ${dayEvents.map(event => {
              const categoryStyle = categoryStyles[event.category];
              return `
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px; padding: 6px 8px; background: ${categoryStyle.bg}; border-radius: 4px; border-left: 3px solid ${categoryStyle.color}; word-wrap: break-word; overflow-wrap: break-word;">
                  <div style="display: flex; align-items: center; flex: 1; min-width: 0;">
                    <i class="${categoryStyle.icon}" style="color: ${categoryStyle.color}; margin-right: 8px; font-size: 12px; flex-shrink: 0;"></i>
                    <div style="flex: 1; min-width: 0;">
                      <div style="font-size: 12px; font-weight: bold; color: ${categoryStyle.color}; word-wrap: break-word;">${event.title}</div>
                      <div style="font-size: 10px; color: #666; word-wrap: break-word;">${event.time} • ${event.category}</div>
                    </div>
                  </div>
                  <button onclick="deleteEvent('${dateStr}', '${event.title}')" style="background: #dc3545; color: white; border: none; border-radius: 3px; padding: 4px 6px; font-size: 10px; cursor: pointer; flex-shrink: 0; margin-left: 8px;">
                    <i class="fas fa-trash"></i>
                  </button>
                </div>
              `;
            }).join('')}
          </div>
        `;
      }
    });
    
    if (!filteredEvents) {
      filteredEvents = '<p style="color: #666; font-size: 12px; text-align: center; padding: 20px;">No events found matching your search</p>';
    }
    
    eventsList.innerHTML = filteredEvents;
  }

  // Close side panel when clicking outside
  document.addEventListener('click', function(event) {
    const panel = document.getElementById('side-panel');
    const toggleBtn = document.getElementById('toggle-btn');
    
    // Check if click is outside both panel and toggle button
    if (!panel.contains(event.target) && !toggleBtn.contains(event.target)) {
      if (panel.classList.contains('show')) {
        togglePanel();
      }
    }
  });

  // Initialize panel as closed
  document.addEventListener('DOMContentLoaded', function() {
    const panel = document.getElementById('side-panel');
    const toggleBtn = document.getElementById('toggle-btn');
    
    // Ensure panel starts closed
    panel.classList.remove('show');
    toggleBtn.classList.remove('active');
    
    const arrow = toggleBtn.querySelector('.arrow');
    if (arrow) {
      arrow.textContent = '▼';
    }
  });
</script>