<template>
    <div v-if="loader_status" class="overlay">
        <div class="loader-wrapper">
            <div class="spinner">
                <div class="double-bounce1"></div>
                <div class="double-bounce2"></div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
export default {
    data() {
        return {
            loader_status: false,
        }
    },
    mounted() {
        
    },
}
</script>

<style scoped>
.overlay {
    background-color: aqua;
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    z-index: 4000;
}

.loader-wrapper {
    z-index: 4100;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}
.spinner {
  width: 40px;
  height: 40px;

  position: relative;
  margin: 100px auto;
}

.double-bounce1, .double-bounce2 {
  width: 100%;
  height: 100%;
  border-radius: 50%;
  background-color: #333;
  opacity: 0.6;
  position: absolute;
  top: 0;
  left: 0;
  
  -webkit-animation: sk-bounce 2.0s infinite ease-in-out;
  animation: sk-bounce 2.0s infinite ease-in-out;
}

.double-bounce2 {
  -webkit-animation-delay: -1.0s;
  animation-delay: -1.0s;
}

@-webkit-keyframes sk-bounce {
  0%, 100% { -webkit-transform: scale(0.0) }
  50% { -webkit-transform: scale(1.0) }
}

@keyframes sk-bounce {
  0%, 100% { 
    transform: scale(0.0);
    -webkit-transform: scale(0.0);
  } 50% { 
    transform: scale(1.0);
    -webkit-transform: scale(1.0);
  }
}
</style>