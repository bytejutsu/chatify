import { onMounted, onUnmounted } from 'vue';
import axios from 'axios';

export default function useHeartbeat() {
    let interval;

    const startHeartbeat = () => {
        interval = setInterval(() => {
            axios.post('/user/heartbeat')
                .then(response => {
                    // Handle successful response if needed
                })
                .catch(error => {
                    if (error.response && error.response.status === 401) {
                        // Handle unauthorized (session expired) if needed
                    }
                });
        }, 5 * 60 * 1000); // Send every 5 minutes
    };

    const stopHeartbeat = () => {
        clearInterval(interval);
    };

    onMounted(startHeartbeat);
    onUnmounted(stopHeartbeat);
}
