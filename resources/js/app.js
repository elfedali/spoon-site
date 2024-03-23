import "./bootstrap";

import Alpine from "alpinejs";
import persist from "@alpinejs/persist";

window.Alpine = Alpine;
Alpine.plugin(persist);
Alpine.start();

// flatpickr
import flatpickr from "flatpickr";

document.addEventListener("alpine:init", () => {
    Alpine.data("flatpickr", () => ({
        init() {
            this.$watch("value", (value) => {
                if (this.fp) {
                    this.fp.setDate(value, false);
                }
            });
        },
        fp: null,
        value: null,
        setup() {
            this.fp = flatpickr(this.$refs.input, {
                dateFormat: "Y-m-d",
                onChange: (selectedDates, dateStr) => {
                    this.value = dateStr;
                },
            });
        },
    }));
});
