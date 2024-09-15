import { onTTFB, onFCP, onFID, onLCP, onCLS, onINP } from "./vendor/web-vitals.js";

if ("serviceWorker" in navigator) {
  navigator.serviceWorker.getRegistrations().then(regList => {
    function send ({ name, value }) {
      let data = {
        url: document?.location?.pathname || "unknown",
        userAgent: navigator?.userAgent || "unknown",
        name,
        value,
        platform: navigator?.platform || "unknown",
        cores: navigator?.hardwareConcurrency || "unknown",
        memory: navigator?.deviceMemory || "unknown",
        saveData: navigator?.connection?.saveData || window?.matchMedia("(prefers-reduced-data: reduce)")?.matches || "unknown",
        effectiveConnectionType: navigator?.connection?.effectiveType || "unknown",
        displayWidth: window?.innerWidth || "unknown",
        displayHeight: window?.innerHeight || "unknown",
        serviceWorker: regList.length > 0 && regList[0]?.active?.state === "activated",
        time: performance?.now() || "unknown",
        blockingTime: "n/a"
      };

      if (name === "FID" || name === "INP") {
        data.blockingTime = 0;

        const perfObserver = new PerformanceObserver((list, observer) => {
          const perfEntries = list.getEntries();

          for (var i = 0; i < perfEntries.length; i++) {
            const blockingTime = perfEntries[i].duration - 50;
            data.blockingTime += blockingTime;
          }

          record(data);
          observer.disconnect();
        });

        // register observer for long task notifications
        perfObserver.observe({
          type: "longtask",
          buffered: true
        });
      } else {
        record(data);
      }
    }

    function record (data) {
      const body = JSON.stringify(data);

      // Use `navigator.sendBeacon()` if available, falling back to `fetch()`.
      if ("sendBeacon" in navigator) {
        navigator.sendBeacon("/metrics.php", body);

        return;
      }

      if ("fetch" in window) {
        fetch("/metrics.php", {
          body,
          method: "POST",
          keepalive: true
        });
      }
    }

    onTTFB(send);
    onFCP(send);
    onFID(send);
    onLCP(send);
    onCLS(send);
    onINP(send);
  });
}
