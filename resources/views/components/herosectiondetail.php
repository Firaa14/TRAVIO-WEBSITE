<style>
    /* Hero Section Styling */
    .hero-section {
        position: relative;
        background: url('/photos/hero3.jpg') center/cover no-repeat;
        height: 60vh;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        text-align: center;
    }

    .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.4);
        z-index: 1;
    }

    .hero-content {
        position: relative;
        z-index: 2;
    }

    /* Submenu / Tab Navigation */
    .tab-navigation {
        display: flex;
        justify-content: center;
        background: #fff;
        border-bottom: 2px solid #e5e7eb;
        position: sticky;
        top: 0;
        z-index: 10;
    }

    .tab-navigation a {
        padding: 15px 25px;
        text-decoration: none;
        color: #333;
        font-weight: 600;
        transition: all 0.2s;
    }

    .tab-navigation a.active {
        color: #007bff;
        border-bottom: 3px solid #007bff;
    }

    .tab-navigation a:hover {
        color: #007bff;
    }
</style>